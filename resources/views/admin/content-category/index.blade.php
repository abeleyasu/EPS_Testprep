@extends('layouts.admin')

@section('title', 'Admin Dashboard : Content Category')

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
                    Content Category

                </h3>
                <a href="{{ route('content-categories.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus" ></i> New Content Category
                </a>
            </div>
            <div class="block-content block-content-full table-view">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th class="">Description</th>
                             <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contents as $content)
                        <tr>
                            <td class="fw-semibold fs-sm">{{$content->title}}</td>
                            <td class="fs-sm">
                                {!! $content->description !!}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('content-categories.edit', ['content_category' => $content->id])}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit Milestone">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-content-category"
                                            data-id="{{$content->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Content"
                                            onclick="deleteItem({{ $content->id }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-form-{{$content->id}}" action="{{ route('content-categories.destroy',['content_category' => $content->id]) }}" method="POST" style="display: none;">
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
@endsection

@section('admin-script')

    <script>


    </script>
@endsection
