@extends('layouts.admin')

@section('title', 'Admin Dashboard : Edit Question')

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <form action="{{route('questions.update',$question->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="content content-boxed">
            <!-- Dynamic Table Full -->
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Edit Question</h3>
                            {{--<a target="_blank" class="btn w-25 btn-alt-success" href="{{ route('questions.preview',['section' => $question->id]) }}">
                                <i class="fa fa-fw fa-eye me-1 opacity-50"></i> Preview
                            </a>--}}
                        </div>
                        <div class="block-content block-content-full">
                            <div class="mb-2">
                                <label for="name" class="form-label">Title:</label>
                                <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('title') ? 'is-invalid' : ''}}"
                                    id="title" name="title" placeholder="Title" value="{{$question->title}}" required>
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label" for="type">Type</label>
                                <select id="type" name="type" class="form-control">
                                    <option value="">Select type</option>
                                    <option value="choiceOneInFourPass" {{ $question->type == "choiceOneInFourPass" ? "selected" : "" }}>choiceOneInFourPass</option>
                                    <option value="choiceOneInFive" {{ $question->type == "choiceOneInFive" ? "selected" : "" }}>choiceOneInFive</option>
                                    <option value="choiceMultInFourFill" {{ $question->type == "choiceMultInFourFill" ? "selected" : '' }}>choiceMultInFourFill</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label class="form-label" for="format">Format</label>
                                <select id="format" name="format" class="form-control" onchange="appendPassages(this)">
                                    <option value="">Select Format</option>
                                    <option value="SAT" {{ $question->format == "SAT" ? "selected" : "" }}>SAT</option>
                                    <option value="ACT" {{ $question->format == "ACT" ? "selected" : "" }}>ACT</option>
                                    <option value="PSAT" {{ $question->format == "PSAT" ? "selected" : "" }}>PSAT</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label class="form-label" for="passages_id">Passage</label>
                                <select id="passages_id" name="passages_id" class="form-control">
                                    <option value="">Select passage</option>
                                        <option value="{{ $question->passages_id }}" selected>{{ Helper::getPassageById($question->passages_id) }}</option>
                                </select>
                            </div>

                            <div class="col-md-6 col-xl-5 mb-4">
                                <button type="submit" class="btn w-100 btn-alt-success">
                                    Update Question
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-xl-4">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Settings</h3>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="card-body py-2 my-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" id="published" name="published"
                                        @if($question->published) checked @endif>
                                    <label class="form-check-label" for="published"></label>
                                    <label><b>Published</b></label>
                                </div>
                            </div>
                                <div class="mb-2">
                                    <label for="type" class="form-label">Parent Module:</label>
                                    <select name="module_id" class="form-control" id="module_id">
                                        @foreach($modules as $module)
                                            <option value="{{$module->id}}"
                                                    @if($module->id == $question->module_id) selected @endif
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
                                        <input type="number" readonly class="form-control" value="{{ $question->order }}"
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
                                                        @if(in_array($tag->id,$question_tags)) checked @endif>
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
                                        <option value="paid" @if($question->status == 'paid') selected @endif>Paid</option>
                                        <option value="unpaid" @if($question->status == 'unpaid') selected @endif>Unpaid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>--}}
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
{{--                    @foreach($questions as $question)--}}
{{--                        <div class="list-group-item">--}}

{{--                        <span class="glyphicon glyphicon-move" aria-hidden="true">--}}
{{--                            <i class="fa-solid fa-grip-vertical"></i>--}}
{{--                        </span>--}}

{{--                            <button class="btn btn-primary"> {{ $question }}</button>--}}
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

            let module_id = $('#module_id').val();

            let _id = '{{ $question->id }}';
            let _title = '{{ $question->title }}';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/modules/${module_id}/questions`,
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

        function appendPassages(data) {
            let format = $(data).val();
            let site_url = $('#site_url').val();
            $.ajax({
                url: `${site_url}/admin/get-passages-by-format/${format}`,
                method: 'get',
                success: (res) => {
                    if(res.success) {
                        let html = ``;
                        html += `<option value="">Select passage</option>`;
                        $.each(res.passages, (i, v) => {
                            html += `<option value="${v.id}">${v.title}</option>`;
                        });

                        $('#passages_id').html(html);
                    } else {
                        console.error("Error: ",resp.message);
                    }
                },
                error: function(err) {
                    console.log("Error: ", err);
                }
            });
        }


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
                    url: `/api/questions/${data.item}/reorder`,
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
