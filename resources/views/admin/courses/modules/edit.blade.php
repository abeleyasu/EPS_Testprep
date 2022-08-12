@extends('layouts.admin')

@section('title', 'Admin Dashboard : Edit Milestone')

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content content-boxed">
        <form action="{{route('modules.update',['module' => $module->id])}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit module</h3>
                            <a target="_blank" class="btn w-25 btn-alt-success" href="{{ route('modules.preview',['module' => $module->id]) }}">
                                <i class="fa fa-fw fa-eye me-1 opacity-50"></i> Preview
                            </a>
                        </div>
                        <div class="block-content block-content-full">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Title:</label>
                                    <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('title') ? 'is-invalid' : ''}}"
                                        id="title" name="title" placeholder="Title" value="{{$module->title}}" required>
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
                                        {!! $module->description !!}
                                    </textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="content" class="form-label">Content:</label>


                                    <textarea id="js-ckeditor" name="content" class=" form-control form-control-lg form-control-alt
                                {{$errors->has('description') ? 'is-invalid' : ''}}" id="content" name="content"
                                            placeholder="Milestone Description"
                                            required>
                                        {!! $module->content !!}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                <div class="holder">
                                @if($module->coverimage)
                                <img id="imgPreview" src="/Image/{{$module->coverimage}}" alt="pic" width="200" />   
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

                                <h3>MODULES SECTIONS</h3>
                                <div class="card mb-2">
                                    @foreach($module->sections as $section)
                                        <div class="card-body row">

                                            <div class="col-12 milestone-detail{{$module->id}}">

                                                    <div class="my-3">
                                                        <span class="mx-4"><i class="fa-solid fa-list"></i> </span><a href="/admin/course-management/sections/{{$section->id}}/edit" target="__blank"> {!! $section->title !!}</a>
                                                        <span class="float-end">
                                                                <button type="button" class="btn btn-success btn-sm mx-3" onclick="showSectionDetail({{$section->id}})">
                                                                    <i class="fa-solid fa-arrow-down"></i>
                                                                </button>
                                                                <span class="badge bg-success">sections</span>
                                                            </span>
                                                        @foreach($section->tasks as $task)

                                                            <div class="mx-6 my-2 collapse hide section-detail{{$section->id}}"><i class="fa-solid fa-list"></i><a href="/admin/course-management/tasks/{{$task->id}}/edit" target="__blank">  {!! $task->title !!}</a>

                                                                <span class="text-center badge bg-danger ml-4">tasks</span>
                                                            </div>

                                                        @endforeach
                                                    </div>

                                            </div>
                                        </div>
                                    @endforeach

                                    
                                </div>
							<a href="{{route('sections.create')}}" class="addchild btn w-100 btn-alt-light text-center"
                                            >
                                        <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Section
                                    </a>
                            <div class="col-md-6 col-xl-5 mb-4">
                                <button type="submit" class="btn w-100 btn-alt-success">
                                    Update Module
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
                                        <input class="form-check-input" type="checkbox" value="1" id="published" name="published"
                                            @if($module->published) checked @endif>
                                        <label class="form-check-label" for="published"></label>
                                        <label><b>Published</b></label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="type" class="form-label">Parent Milestone:</label>
                                <select name="milestone_id" class="form-control" id="milestone_id">
                                    @foreach($milestones as $milestone)
                                        <option value="{{$milestone->id}}"
                                                @if($milestone->id == $module->milestone_id) selected @endif
                                        > {{ $milestone->name }}</option>
                                    @endforeach
                                </select>
                                @error('milestone')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="order">Order</label>

                                <div class="input-group mb-3">
                                    <input type="number" readonly class="form-control" value="{{ $module->order }}"
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
                                                    @if(in_array($tag->id,$module_tags)) checked @endif>
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
                                    <option value="unpaid" @php if($module->status == 'unpaid'){ echo 'selected';} @endphp >Unpaid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveOrder()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- END Main Container -->
@endsection

@section('admin-script')

    <script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>

    <script>
	var currentmodid = '<?php echo $module->id; ?>';
         $(document).ready(()=>{
		  $('#course_cover_image').change(function(){
			const file = this.files[0];
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
        function openOrderDialog() {


            let milestone_id = $('#milestone_id').val();
            let _id = '{{ $module->id }}';
            let _title = '{{ $module->title }}';
            // let

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/milestone/${milestone_id}/modules`,
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
            $('#order').val(order);
            myModal.hide();
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
                CKEDITOR.replace('js-ckeditor-desc',{
					extraPlugins: 'oembed,colorbutton,colordialog,font,ckeditor_wiris',
					allowedContent
				});

                // Add .js-ckeditor-enabled class to tag it as activated
                ckeditorFull.classList.add('js-ckeditor-enabled');
            }
            // Init full text editor
            if (taskCK) {
                CKEDITOR.replace('js-ckeditor-task');

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
					currentModId: currentmodid
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `/api/modules/${data.item}/reorder`,
                    method: 'post',
                    data:data,
                    success: (res) => {
						order = res.currentModuleId;
						$('#order').val(order);	
                    },
                    error: () => {
                        alert('Something went wrong')
                    }
                });
            }
        },);

    </script>
@endsection