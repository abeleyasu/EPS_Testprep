@extends('layouts.admin')

@section('title', 'Admin Dashboard : Sections')

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
                    Sections
                </h3>
                <a href="{{ route('sections.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus" ></i> New Section
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
                        @foreach($sections as $section)
                        <tr>
                            <td class="fw-semibold fs-sm">{{$section->title}}</td>
                            <td class="fs-sm">
                                {!! $section->description !!}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('sections.edit', ['section' => $section->id])}}"
                                       class="btn btn-sm btn-alt-secondary"
                                       data-bs-toggle="tooltip"
                                       title="Edit Section">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-section"
                                            data-id="{{$section->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Section"
                                            onclick="deleteItem({{ $section->id }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-form-{{$section->id}}" action="{{ route('sections.destroy',$section->id) }}" method="POST" style="display: none;">
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
