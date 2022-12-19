@extends('layouts.user')

@section('title', 'HSR | List : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>
                    <h1 class="h2 text-white mb-0">High School Resume Tool</h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="block-content resume-list-table">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter" id="resumeTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Cell Phone</th>
                                <th class="text-center" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($highSchoolResume as $resume)
                                <tr class="resume_remove_{{ $resume->id }}">
                                    <td class="fw-semibold fs-sm">
                                        {{ $resume->id }}
                                    </td>
                                    <td class="fs-sm">
                                        {{ $resume->personal_info->first_name . ' ' . $resume->personal_info->last_name }}
                                    </td>
                                    <td>
                                        {{ $resume->personal_info->email }}
                                    </td>
                                    <td>
                                        {{ $resume->personal_info->cell_phone }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-sm" data-id="{{ $resume->id }}"
                                                onclick="showResumePreview(this)" data-bs-toggle="tooltip" title="Preview">
                                                <i class="fa fa-fw fa-file-pdf"></i>
                                            </button>
                                            <a href="{{ route('admin-dashboard.highSchoolResume.editFetch', ['editid' => $resume->id]) }}"
                                                class="btn btn-sm ms-2" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fa fa-fw fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('admin-dashboard.highSchoolResume.resume.download', ['id' => $resume->id, 'type' => 'download']) }}"
                                                class="btn btn-sm ms-2" data-bs-toggle="tooltip" title="Download">
                                                <i class="fa fa-fw fa-download"></i>
                                            </a>
                                            <a class="btn btn-sm ms-2" data-bs-toggle="tooltip" title="Delete" id="{{$resume->id}}" onclick="deleteResume({{$resume->id}})">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Resume Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- Resume-list Modal -->
    <div class="modal fade bd-example-modal-lg showResumePreviewModal" role="dialog"
        aria-labelledby="modal-block-extra-large" aria-hidden="true"></div>
    <!-- Resume-list Modal -->
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <style>
        .btn:focus {
            box-shadow: none
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <script>
        function deleteResume(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(48 133 214)',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('/user/admin-dashboard/high-school-resume/resume/delete/${id}') }}`,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(resp) {
                            if (resp.success) {
                                $(`#resumeTable .resume_remove_${resp.id}`).remove();
                                toastr.success(resp.message);
                            }
                        },
                        error: function(err) {
                            console.log("err =>>>", err);
                        }
                    });
                }
            })
        }

        $(document).on('submit', '#deleteResumeForm', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#131921',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // console.log(this.id);
                    // let id = $('#deleteResumeForm-'+).attr('data-id');
                    // alert("deleteResumeForm-" + id);
                    $.ajax({
                        url: `{{ url('/user/admin-dashboard/high-school-resume/resume/delete/${id}') }}`,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(resp) {
                            if (resp.success) {
                                $(`#resumeTable .resume_remove_${resp.id}`).remove();
                                toastr.success(resp.message);
                            }
                        },
                        error: function(err) {
                            console.log("err =>>>", err);
                        }
                    });
                    // id = ""
                }
            })
        });

        function showResumePreview(data) {
            let id = $(data).attr('data-id');
            $.ajax({
                url: `{{ url('/user/admin-dashboard/high-school-resume/fetch-resume/${id}') }}`,
                type: 'GET',
                success: function(resp) {
                    if (resp.success) {
                        $('.showResumePreviewModal').html(resp.html);
                        $('.showResumePreviewModal').modal('show');
                    }
                },
                error: function(err) {
                    console.log("err =>>>", err);
                }
            });
        }

        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
@endsection
