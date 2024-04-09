@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
@endsection

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Permission List</h3>
            </div>
            <div class="block-content block-content-full">
                <table id="permission-list" class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <!-- <th></th> -->
                            <th>Permission Name</th>
                            <th style="width: 60%;">Permission Module Name</th>
                            <!-- <th>Order</th>
                            <th style="width: 15%;">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td class="fs-sm">{{$permission['name']}}</td>
                            <td class="fs-sm">
                                {{$permission['modules']['name']}}
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
@endsection
