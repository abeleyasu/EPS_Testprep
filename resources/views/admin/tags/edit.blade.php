@extends('layouts.admin')

@section('title', 'Admin Dashboard : Edit Task')

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Task</h3>
            </div>

            <div class="block-content block-content-full">
                <form action="{{route('tasks.update',['task'=>$task->id])}}" method="POST" >
                    @method('PUT')
                    @csrf
                    <div class="row py-3">
                        <div class="col-md-12">

                            <div class="mb-2">
                                <label for="name" class="form-label">Section:</label>
                                <select class=" form-control {{$errors->has('section_id') ? 'is-invalid' : ''}}"
                                        name="section_id" required >
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}"
                                                @if($task->section_id == $section->id) selected @endif
                                        >{{ $section->title }}</option>
                                    @endforeach
                                </select>

                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('title') ? 'is-invalid' : ''}}"
                                       id="title" name="title" placeholder="Title" value="{{ $task->title }}" required>
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
                            {!! $task->description !!}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-xl-5 mb-4">
                        <button type="submit" class="btn w-100 btn-alt-success">
                            Update Task
                        </button>
                    </div>

                </form>
                <!-- END Edit User Form -->
            </div>
        </div>
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
@endsection

@section('admin-script')

    <script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('assets/js/plugins/Sortable.js')}}"></script>

    <script>
        var order = 0;
        var myModal = new bootstrap.Modal(document.getElementById('dragModal'), {
            keyboard: false
        });
        One.helpersOnLoad(['js-ckeditor']);


        function openOrderDialog() {
            $('#listWithHandle').empty();

            let milestone_id = $('#milestone_id').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/milestone/${milestone_id}/sections`,
                method: 'post',
                success: (res) => {
                    res.data.forEach(i => {

                        $('<div class="list-group-item">\n' +
                            '<span class="glyphicon glyphicon-move" aria-hidden="true">\n' +
                            '<i class="fa-solid fa-grip-vertical"></i>\n' +
                            '</span>\n' +
                            '<button class="btn btn-primary">'+i.title+'</button>\n' +
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




        // List with handle
        Sortable.create(listWithHandle, {
            handle: '.glyphicon-move',
            animation: 150,
            onEnd: function f(evt) {
                order = evt.newIndex+1;
            }
        },);

    </script>
@endsection