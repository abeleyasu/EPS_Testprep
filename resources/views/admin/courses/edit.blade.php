@extends('layouts.admin')

@section('title', 'Admin Dashboard : Course')

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
    <div class="content content-boxed">
        <!-- Dynamic Table Full -->
        <form action="{{route('courses.courseupdate', ['course'=>$course->id])}}" method="POST" enctype="multipart/form-data">

            @csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Course</h3>
						<a target="_blank" class="btn w-25 btn-alt-success" href="{{ route('courses.preview',['course' => $course->id]) }}">
								<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Preview
							</a>
                    </div>
                    <div class="block-content block-content-full">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Title:</label>
                                    <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('name') ? 'is-invalid' : ''}}"
                                     id="name" name="name" placeholder="Title" value="{{$course->title}}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="description" class="form-label">Description:</label>


                                    <textarea id="js-ckeditor-desc" name="description" class="form-control form-control-lg form-control-alt
                                    {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" name="description"
                                              placeholder="Description"
                                              >
                                    {!! $course->description !!}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                <label for="content" class="form-label">Content:</label>


                                <textarea id="js-ckeditor" name="content" class=" form-control form-control-lg form-control-alt
                            {{$errors->has('content') ? 'is-invalid' : ''}}" id="content" name="content"
                                            placeholder="Milestone content">
                                    {!! $course->content !!}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>   
                            <div class="mb-2">
                            <div class="holder">
                                @if($course->coverimage)
                                <img id="imgPreview" src="{{ asset('public/Image/'.$course->coverimage) }}" alt="pic" width="200" />
                                <input type = "hidden" name="course_cover_image_old" class="form-label" id="course_cover_image_old" value="{{ $course->coverimage }}" />   
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
							<div class="row">
							    <h4>Course MileStones</h4>
                                <div class="card mb-2">
                                @foreach($milestones as $milestone)

                                <div class="mx-6 my-2 milestone-detail{{$milestone->id}}"><i class="fa-solid fa-list"></i><a href="/admin/course-management/milestones/{{$milestone->id}}/edit" target="__blank">  {!! $milestone->name !!}</a>
                                    <span class="text-center badge bg-danger ml-4">Milestone</span>
                                </div>

                                @endforeach
                                   
                                </div>
							</div>
							<a href="{{ route('milestones.create')}}" class="addchild btn w-100 btn-alt-light text-center"
                                        >
                                    <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Milestone
                                </a>
                                <div class="col-md-6 col-xl-5 mb-4">
                                    <button type="submit" class="btn w-100 btn-alt-success">
                                        Update Course
                                    </button>
                                </div>
							
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">

                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title"></h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="card mb-2">
                                <div class="card-body py-2 my-2">
                                    <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="true" id="published" name="published"
                                        @if($course->published) checked @endif>
                                        <label class="form-check-label" for="published"></label>
                                        <label><b>Published</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Settings</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="mb-2">
                                    <label for="type" class="form-label">User Type:</label>
                                    <select name="user_type" class="form-control">
                                        @foreach($usersRoles as $usersRole)
                                            <option value="{{$usersRole->id}}">{{$usersRole->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_type')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="duration" class="form-label">Duration</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="number" min="0" name="hour" class=" form-control" id="hour" value="{{floor($course->duration/60)}}">
                                        </div>
                                        <label class="col-2 form-label">hours</label>
                                        <div class="col-3">
                                            <input type="number" min="0" name="minute" class="form-control" id="minute" onkeydown="calculateTime(this)" value="{{$course->duration%60}}">
                                        </div>
                                        <label class="col-2 form-label">minutes</label>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="order">Order</label>

                                    <div class="input-group mb-3">
                                        <input type="number" readonly class="form-control" name="order" value="{{ $course->order }}"
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
                                                    @if(in_array($tag->id,$course_tags)) checked @endif>
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
                                        <option value="unpaid" @php if($course->status == 'unpaid'){ echo 'selected';} @endphp >Unpaid</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    <!-- END Edit User Form -->
    </div>
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
{{--                    @foreach($milestones as $milestone)--}}
{{--                    <div class="list-group-item">--}}

{{--                        <span class="glyphicon glyphicon-move" aria-hidden="true"--}}
{{--                              id="{{$milestone->id}}">--}}
{{--                            <i class="fa-solid fa-grip-vertical"></i>--}}
{{--                        </span>--}}

{{--                        <button class="btn btn-primary" value="{{ $milestone->id }}"> {{ $milestone->name }}</button>--}}
{{--                    </div>--}}

{{--                    @endforeach--}}
{{--                    <div class="list-group-item">--}}

{{--                        <span class="glyphicon glyphicon-move" aria-hidden="true">--}}
{{--                            <i class="fa-solid fa-grip-vertical"></i>--}}
{{--                        </span>--}}

{{--                        <button class="btn btn-primary"> Current Milestone</button>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveOrder()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->


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
                                        
                                    </div>
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

    @include('admin.preview.milestone')
@endsection
@section('admin-script')

    <script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>

    <script>
	var currentOrderId = '<?php echo $course->id; ?>';
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
        var previewModal = new bootstrap.Modal(document.getElementById('previewModal'), {
            keyboard: false
        });
        //One.helpersOnLoad(['js-ckeditor']);
        var allowedContent = true;
		CKEDITOR.replace( 'js-ckeditor',{
			extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
			allowedContent,
		});
        function calculateTime(val) {
            setTimeout(() => {
                let _min = $(val).val();

                if(_min >= 60) {
                    let hr = Math.floor(_min/60);
                    let min = _min%60;
                    $('#hour').val(hr);
                    $('#minute').val(min);
                }
            },100);
        }
        // function openOrderDialog() {
        //     myModal.show();
        // }

        function openOrderDialog() {

            $('#listWithHandle').empty();


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/courses/all`,
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
            $('#order').val(order);
            myModal.hide();
        }
        function addTag(evt){
            let tag = $("#tag");
            if (evt.keyCode == 13){
                evt.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/tags',
                    method: 'post',
                    data:{tag:tag.val()},
                    success: (res) => {
                        res = res.tag;
                        $('<div class="col" >' +
                            '<div class="form-check form-block">' +
                            '<input class="form-check-input" type="checkbox" value="'+res.id+'" id="example-checkbox-block'+res.id+'" name="tags[]">' +
                            '<label class="form-check-label label-check" for="example-checkbox-block'+res.id+'" >' +
                            '<span class="d-block fs-sm text-muted">'+res.name+'</span>' +
                            '</label></div></div>').appendTo('.tag-div');
                        tag.val('');
                    }
                });
            }
        }

        function showDetail(id) {
            $('.milestone-detail'+id).collapse('toggle')
        }
        function showSectionDetail(id) {
            $('.section-detail'+id).collapse('toggle')
        }

        $(document).ready(function(){
            let ckeditorFull = document.querySelector('#js-ckeditor-desc:not(.js-ckeditor-enabled)');
            let taskCK = document.querySelector('#js-ckeditor-task:not(.js-ckeditor-enabled)');

            // Init full text editor
            if (ckeditorFull) {
                var allowedContent = true;
                CKEDITOR.replace( 'js-ckeditor-desc', {
                customConfig: '/assets/js/plugins/ckeditor/config.js',
                filebrowserBrowseUrl : '/browse.php',
                filebrowserUploadUrl : '/upload.php',
                extraPlugins: 'oembed, colorbutton,colordialog,font,ckeditor_wiris',
			    allowedContent,
			    colorButton_enableMore: true
                
            });

                // Add .js-ckeditor-enabled class to tag it as activated
                ckeditorFull.classList.add('js-ckeditor-enabled');
            }

            // Init full text editor
            if (taskCK) {
                CKEDITOR.replace('js-ckeditor-task',{
                filebrowserBrowseUrl : '/browse.php',
                filebrowserUploadUrl : '/upload.php'
                
            });

                // Add .js-ckeditor-enabled class to tag it as activated
                taskCK.classList.add('js-ckeditor-enabled');
            }
        });

        // List with handle
        Sortable.create(listWithHandle, {
            handle: '.glyphicon-move',
            animation: 150,
                onEnd: function(evt) {
                let data = {
                    new_index: evt.newIndex+1,
                    old_index: evt.oldIndex+1,
                    item: evt.item.children[1].value,
					currentOrderId: currentOrderId
                };
				
					/*$('#order').val(evt.newIndex+1);*/
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `/api/courses/${data.item}/reorder`,
                        method: 'post',
                        data:data,
                        success: (res) => {
							order = res.currentOrder;
							$('#order').val(order);							
                        },
                        error: () => {
                            alert('Something went wrong')
                        }
                    });
            }
        },);

        function previewMilestone() {
            previewModal.show();
        }
    </script>
@endsection
