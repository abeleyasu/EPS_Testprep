@extends('layouts.admin')

@section('title', 'Admin Dashboard : Modules')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/admin.css') }}">


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
                        Custom Quizzes

                    </h3>
                </div>
                <div class="block-content block-content-full table-view">
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Title</th>
                                <th>Format</th>
                                <th>Created On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customQuizzes as $quiz)
                                <tr>
                                    <td class="fw-semibold fs-sm">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold fs-sm">{{ $quiz->title }}</td>
                                    <td class="fw-semibold fs-sm">{{ $quiz->format }}</td>
                                    <td class="fw-semibold fs-sm">{{ $quiz->created_at }}</td>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    @if (session('success'))
        <script>
            swal({
                title: "Success",
                text: "{{ session('success') }}",
                type: "success",
                icon: "success",
                buttons: {
                    confirm: {
                        text: "OK",
                        value: true,
                        visible: true,
                        className: "btn btn-primary",
                        closeModal: true
                    }
                }
            });
        </script>
    @endif

    <script>
        function deleteItem_fun(id) {
            // var id = $(this).data("id");
            var form = $('#delete-item-form-' + id);
            event.preventDefault();
            swal({
                    title: "Are you sure?",
                    text: "But you will still be able to retrieve this.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, archive it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        form.submit();
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
        }
    </script>
@endsection
