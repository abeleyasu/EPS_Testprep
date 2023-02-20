@extends('layouts.admin')

@section('title', 'Admin Dashboard : Quiz Tags')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">

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
                    Quiz Tags
                </h3>

                <button type="button" class="btn btn-alt-primary push"
                        data-bs-toggle="modal"
                        data-bs-target="#modal-block-large">
                    <i class="fa fa-plus" ></i> New Quiz Tag
                </button>
            </div>
            <div class="block-content block-content-full table-view">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden">
                    <thead>
                        <tr>
                            <th>Name</th>
                             <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quiztags as $quiztag)
                        <tr>
                            <td class="fw-semibold fs-sm">{{$quiztag->name}}</td>

                            <td>
                                <div class="btn-group">
                                  <!-- <button type="button"
                                       class="btn btn-sm btn-alt-secondary"
                                       data-id="{{$quiztag->id}}"
                                       data-bs-toggle="tooltip"
                                       data-bs-target="#modal-block-large-edit"
                                       title="Edit Tag">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button> -->
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-quiztag"
                                            data-id="{{$quiztag->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Quiztag"
                                            onclick="deleteItem({{ $quiztag->id }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-form-{{$quiztag->id}}" action="{{ route('quiztags.destroy',$quiztag->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                    </form>
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

<!-- Large Block Modal -->
<div class="modal" id="modal-block-large" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Quiz Tag</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('quiztags.store') }}" method="post" class="form-row">
                    @csrf
                <div class="block-content fs-sm">

                    <div class="col-6 m-4">
                    <label for="name" class="form-label"> Quiz Tag name</label>
                    <input type="text" maxlength="30"
                           id="quiztag"
                           name="quiztag"
                           placeholder="add quiztag"
                           class="form-control"
                    />
                    </div>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Large Block Modal -->

<!-- Large Block Modal -->
<div class="modal" id="modal-block-large-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Quiz Tag</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('quiztags.store') }}" method="post" class="form-row">
                    @csrf
                <div class="block-content fs-sm">

                    <div class="col-6 m-4">
                    <label for="name" class="form-label"> Quiz Tag name</label>
                    <input type="text" maxlength="30"
                           id="quiztag"
                           name="quiztag"
                           placeholder="add quiz tag"
                           class="form-control"
                    />
                    </div>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Large Block Modal -->
@endsection

@section('admin-script')

    <script>


    </script>
@endsection
