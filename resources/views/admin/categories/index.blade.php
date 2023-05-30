@extends('layouts.admin')

@section('title', 'Admin Dashboard : Categories')

@section('page-style')
<!-- Stylesheets -->
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet"
    href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">

<link rel="stylesheet" id="css-main" href="{{asset('assets/css/admin.css')}}">


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
                    Categories
                </h3>

                <button type="button" class="btn btn-alt-primary push" data-bs-toggle="modal"
                    data-bs-target="#modal-block-large">
                    <i class="fa fa-plus"></i> New Category
                </button>
            </div>
            <div class="block-content block-content-full table-view">
                <div class="row">
                    <div class="col-1">
                    </div>
                    <div class="col-4">
                        <h5>NAME</h5>
                    </div>
                    <div class="col-4">
                        <h5>ACCESS</h5>
                    </div>
                    <div class="col-3">
                        <h5>TIME</h5>
                    </div>
                </div>

                @foreach($categories as $category)
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <div class="row">
                            <div class="col-1">
                                <h2 class="accordion-header" id="flush-headingOne-{{$category->id}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-{{$category->id}}" aria-expanded="false" aria-controls="flush-collapseOne-{{$category->id}}"></button>
                                </h2>
                            </div>
                            <div class="col-4" style="padding-top: 10px">
                                <h6>{{$category->name}} ({{\App\Models\SubCategory::where('c_id',$category->id)->count()}})<h6>
                            </div>
                            <div class="col-4" style="padding-top: 10px">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-id="{{$category->id}}"
                                            data-bs-target="#sub-category-modal-block-large" onclick="addsubdata('{{ $category->id }}','{{ $category->name }}','{{ $category->time }}')">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-id="{{$category->id}}"
                                            data-bs-target="#modal-block-large-edit" onclick="updatedata('{{ $category->id }}','{{ $category->name }}','{{ $category->time }}')">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-category"
                                            data-id="{{$category->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete category"
                                            onclick="deleteItem({{ $category->id }})">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-form-{{$category->id}}" action="{{ route('categories.destroy',$category->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                            <div class="col-3" style="padding-top: 10px">
                                <h6 style="padding-top: 10px">{{$category->time}}<h6>
                            </div>
                        </div>
                            <div id="flush-collapseOne-{{$category->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne-{{$category->id}}" data-bs-parent="#accordionFlushExample">
                            
                             @foreach(\App\Models\SubCategory::where('c_id',$category->id)->get() as $subcategory)
                            
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-1">
                                        </div>
                                        <div class="col-4">
                                            {{$subcategory->name}}
                                        </div>
                                        <div class="col-4">
                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-id="{{$subcategory->id}}"
                                            data-bs-target="#sub-category-modal-block-large-edit" onclick="updatedatasub('{{ $subcategory->id }}','{{ $subcategory->name }}','{{ $subcategory->time}}','{{ $subcategory->c_id }}')">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                            <div class="btn-group">
                                                <button type="button"
                                                        class="btn btn-sm btn-alt-secondary delete-category"
                                                        data-id="{{$subcategory->id}}"
                                                        data-bs-toggle="tooltip"
                                                        title="Delete subcategory"
                                                        onclick="deleteItem({{ $subcategory->id }})">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>
                                                <form id="delete-form-{{$subcategory->id}}" action="{{ route('sub_categories.destroy',$subcategory->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            {{$subcategory->time}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- END Dynamic Table Full -->
        </div>
        <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Large Block Modal -->
<div class="modal" id="modal-block-large" tabindex="-1" role="dialog" aria-labelledby="modal-block-large"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Category</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('categories.store') }}" method="post" class="form-row">
                    @csrf
                    <div class="block-content fs-sm">

                        <div class="col-6 m-4">
                            <label for="name" class="form-label"> Category name</label>
                            <input type="text" maxlength="30" id="name" name="name" placeholder="add category"
                                class="form-control" /></br>
                            <label for="time" class="form-label"> Time</label>
                            <input type="text" maxlength="30" id="time" name="time" placeholder="add time"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Large Block Modal -->

<!-- Large Block Modal -->
<div class="modal" id="modal-block-large-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-large"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Category</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('categories.update',['category'=> $category->id])}}" method="post" class="form-row" id="update_category_form">
                    @method('PUT')
                    @csrf
                    <div class="block-content fs-sm">

                        <div class="col-6 m-4">
                            <label for="name" class="form-label"> Category name</label>
                            <input type="text" maxlength="30" id="edit_name" name="name" placeholder="add category" class="form-control" /></br>
                            <input type="hidden" maxlength="30"  id="edit_id" name="id" placeholder="add category" class="form-control" /></br>
                            <label for="time" class="form-label"> Time</label>
                            <input type="text" maxlength="30" id="edit_time" name="time" placeholder="add time" class="form-control" />
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Large Block Modal -->

<!-- Sub Category Large Block Modal -->
<div class="modal" id="sub-category-modal-block-large" tabindex="-1" role="dialog" aria-labelledby="modal-block-large"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Sub Category</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('sub_categories.store') }}" method="post" class="form-row">
                    @csrf
                    <div class="block-content fs-sm">

                        <div class="col-6 m-4">
                            <label for="name" class="form-label"> Sub Category name</label>
                            <input type="text" maxlength="30" id="sub_name" name="name" placeholder="add sub category"
                                class="form-control" /></br>
                                <label for="name" class="form-label">Parent Category</label>
                                <select class=" form-control {{$errors->has('c_id') ? 'is-invalid' : ''}}" name="c_id" id="sub_c_id" required >
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select></br>
                            <label for="time" class="form-label"> Time Amount</label>
                            <input type="text" maxlength="30" id="sub_time" name="time" placeholder="add sub time"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Sub Category END Large Block Modal -->

<!-- Sub Edit Large Block Modal -->
<div class="modal" id="sub-category-modal-block-large-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-large"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Sub Category</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{route('sub_categories.update',['sub_category'=> $subcategory->id])}}" method="post" class="form-row" id="update_sub_category_form">
                    @method('PUT')
                    @csrf
                    <div class="block-content fs-sm">

                        <div class="col-6 m-4">
                            <label for="name" class="form-label"> Sub Category name</label>
                            <input type="text" maxlength="30" id="edit_sub_name" name="name" placeholder="add sub category" class="form-control" /></br>
                            <input type="hidden" maxlength="30"  id="edit_sub_id" name="id" placeholder="add sub category" class="form-control" /></br>
                            <label for="name" class="form-label">Parent Category</label>
                                <select class=" form-control {{$errors->has('c_id') ? 'is-invalid' : ''}}" name="c_id" id="edit_sub_c_id" required >
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select></br>
                            <label for="time" class="form-label"> Time Amount</label>
                            <input type="text" maxlength="30" id="edit_sub_time" name="time" placeholder="add time" class="form-control" />
                        </div>
                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Sub Edit END Large Block Modal -->
@endsection

@section('admin-script')

<script>
    function updatedata(id, name, time) {
            var urls = $('#update_category_form').attr('action').split('categories');
            var newurl = urls[0]+'categories/'+id;
            $('#update_category_form').attr('action',newurl);
            $('#edit_name').val(name);
            $('#edit_time').val(time);
            $('#edit_id').val(id);
        }
    function addsubdata(id, name, time) {
        //alert('dd');exit;
            $('#sub_c_id').val(id);
            // $('#sub_time').val(time);
            $('#sub_id').val(id);
        }
    function updatedatasub(id, name, time, c_id) {
        var urls = $('#update_sub_category_form').attr('action').split('sub_categories');
            var newurl = urls[0]+'sub_categories/'+id;
            $('#update_sub_category_form').attr('action',newurl);
        //alert('dd');exit;
            $('#edit_sub_name').val(name);
            $('#edit_sub_time').val(time);
            $('#edit_sub_id').val(id);
            $('#edit_sub_c_id').val(c_id);
        }
</script>
@endsection