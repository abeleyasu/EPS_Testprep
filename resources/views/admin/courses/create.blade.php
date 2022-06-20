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
        <form action="{{route('courses.store')}}" method="POST">
            @csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add Course</h3>
                    </div>
                    <div class="block-content block-content-full">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Title:</label>
                                    <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('name') ? 'is-invalid' : ''}}"
                                     id="name" name="name" placeholder="Title" value="{{old('name')}}" required>
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
                                    {{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>




                            <div class="col-md-12 col-xl-12 mb-4">
                                <!--<button type="button" class="btn w-25 btn-alt-success"
                                        onclick="previewMilestone()">
                                    <i class="fa fa-fw fa-eye me-1 opacity-50"></i> Preview
                                </button>-->
                                <button type="submit" class="btn w-25 btn-alt-success">
                                    <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add Course
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
                                        <input class="form-check-input" type="checkbox" value="true" id="published" name="published">
                                        <label class="form-check-label" for="published"></label>
                                        <label><b>Published</b></label>
                                    </div>
                                </div>
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
                                        @foreach($sections as $section)
                                            <option value="{{$section->id}}">{{ $section->title }}</option>
                                        @endforeach
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
        var order = 0;
        var myModal = new bootstrap.Modal(document.getElementById('dragModal'), {
            keyboard: false
        });
        var previewModal = new bootstrap.Modal(document.getElementById('previewModal'), {
            keyboard: false
        });
        One.helpersOnLoad(['js-ckeditor']);

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
                url: `/api/milestones/all`,
                method: 'post',
                success: (res) => {
                    res.data.forEach(i => {

                        $('<div class="list-group-item">\n' +
                            '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                            '<i class="fa-solid fa-grip-vertical"></i>\n' +
                            '</span>\n' +
                            '<button class="btn btn-primary" value="'+i.id+'">'+i.name+'</button>\n' +
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
                CKEDITOR.replace('js-ckeditor-desc');

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
                    item: evt.item.children[1].value
                };

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `/api/milestone/${data.item}/reorder`,
                        method: 'post',
                        data:data,
                        success: (res) => {
							order = data.new_index;	
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
