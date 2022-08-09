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

    @include('admin.preview.task')


@endsection
@section('admin-script')

    <script src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/plugins/select2/js/select2.min.js')}}"></script>


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

        One.helpersOnLoad(['js-ckeditor', 'jq-select2']);
        var allowedContent = true;
		CKEDITOR.replace( 'js-ckeditor',{
			extraPlugins: 'videoembed,colorbutton,colordialog,font',
			allowedContent
		});

        function previewModal() {}


    </script>
@endsection
