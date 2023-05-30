@extends('layouts.admin')

@section('title', 'Admin Dashboard : High School Resume Settings')

@section('admin-content')
<main id="main-container">
    <div class="content">
        <div class="block block-rounded tab-container ">
            <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                <li class="nav-item">
                    <div class="nav-link college_tablinks active" id="btabs-static-high-school-resume-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-high-school-resume" role="tab" aria-controls="btabs-static-high-school-resume" aria-selected="true">High School Resume</div>
                </li>
                <li class="nav-item">
                    <div class="nav-link college_tablinks" id="btabs-static-college-application-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-college-application" role="tab" aria-controls="btabs-static-college-application" aria-selected="false">College Application Deadline</div>
                </li>
                <li class="nav-item">
                    <div class="nav-link college_tablinks" id="btabs-static-initial-college-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-initial-college" role="tab" aria-controls="btabs-static-initial-college" aria-selected="false">Initial College List</div>
                </li>
                <li class="nav-item">
                    <div class="nav-link college_tablinks" id="btabs-static-cost-comparison-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-cost-comparison" role="tab" aria-controls="btabs-static-cost-comparison" aria-selected="false">Cost Comparison</div>
                </li>
            </ul>
            <div class="block-content tab-content college-content">
                <div class="tab-pane active" id="btabs-static-high-school-resume" role="tabpanel" aria-labelledby="btabs-static-high-school-resume-tab">
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h3 class="block-title">
                                Courses
                            </h3>
                            <button class="btn btn-sm btn-primary" onclick="show_add_course();">
                                <i class="fa fa-plus"></i> Add Course
                            </button>
                        </div>
                        <div class="block-content block-content-full table-view">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden" id="courses_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Course</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($educationCourses as $educationCourse)
                                        <tr class="remove_course_{{ $educationCourse->id }}">
                                            <td class="fw-semibold fs-sm">{{ $educationCourse->id }}</td>
                                            <td class="course_name">{{ $educationCourse->name }}</td>
                                            <td class="course_type">{{ $educationCourse->course_type == 1 ? 'IB Course' : 'AP Course' }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-alt-primary" data-bs-toggle="tooltip" title="Edit Section" data-id="{{ $educationCourse->id }}" onclick="edit_courses(this)">
                                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-alt-danger ms-2" data-id="{{ $educationCourse->id }}" data-bs-toggle="tooltip" title="Delete Section" onclick="delete_course(this)">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No Course Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="btabs-static-college-application" role="tabpanel" aria-labelledby="btabs-static-college-application-tab">
                    College Application Deadline
                </div>
                <div class="tab-pane" id="btabs-static-initial-college" role="tabpanel" aria-labelledby="btabs-static-initial-college-tab">
                    Initial College List
                </div>
                <div class="tab-pane" id="btabs-static-cost-comparison" role="tabpanel" aria-labelledby="btabs-static-cost-comparison-tab">
                    Cost Comparison
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Course Modal -->
<div class="modal" id="course_model" tabindex="-1" role="dialog" aria-labelledby="modal-block-extra-large" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default block_school_modal">
                    <h3 class="block-title course_title">Add Course</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="course_form" autocomplete="off">
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label" for="course_name">Course Name</label>
                                    <input type="text" class="form-control" id="course_name" name="name" placeholder="Enter IB Course">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="course_type" class="form-label">Course Type</label>
                                    <select class="form-select" id="course_type" name="course_type">
                                        <option value="">Select an option</option>
                                        <option value="1">IB Course</option>
                                        <option value="2">AP Course</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end">
                            <button type="button" class="btn btn-alt-secondary me-1" onclick="$('#course_model').modal('hide')">Close</button>
                            <button type="submit" class="btn btn-alt-success modal_submit_btn" onclick="add_course();return false;">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Course Modal -->
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<style>
    .tab-container .college_tablinks.active,
    .block_school_modal {
        background-color: #1f2937 !important;
        color: #fff !important;
    }

    .tab-container .college_tablinks {
        background-color: transparent;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 11px 20px;
        transition: 0.3s;
        color: #1f2937;
        font-size: 14px;
        font-weight: 600;
        border-radius: 0 !important;
    }

    .nav-tabs-block .college_tablinks:hover {
        color: #1f2937;
        background-color: transparent;
        border-color: transparent;
    }

    .block-header-default .btn-block-option {
        color: #ffffff;
    }

    .submit-btn:focus {
        box-shadow: none;
    }
</style>
@endsection

@section('admin-script')
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script>
    function show_add_course() {
        $('#course_model .course_title').text('Add Model');
        $('#course_name').val("");
        $('#course_type').val("");
        $('#course_model .modal_submit_btn').removeAttr('data-id');
        $('#course_model .modal_submit_btn').text('Add');
        $('#course_model .modal_submit_btn').attr('onclick','add_course(this);return false;');
        $('#course_model').modal('show');
    }

    function add_course() {
        let course_name = $('#course_name').val();
        let course_type = $('#course_type').val();

        if(course_name == ""){
            toastr.error("please select a course");
            return false;
        }

        if(course_type == ""){
            toastr.error("please select a course type");
            return false;
        }

        $.ajax({
            url: `{{ route('admin.highSchoolResume.addCourse') }}`,
            type: "POST",
            dataType: "JSON",
            data: {
                "_token": "{{  csrf_token() }}",
                "course_name": course_name,
                "course_type": course_type
            },
            success: function(resp) {
                if (resp.success) {
                    fetch_all_courses();
                    $('#course_name').val("");
                    $('#course_type').val("");
                    $('#course_model').modal('hide');
                    toastr.success(resp.message);
                }
            },
            error: function(err) {
                console.log("err =>>>", err);
            }
        });
    }

    function edit_courses(data) {
        let id = $(data).attr('data-id');

        $.ajax({
            url: `{{ url('/admin/high-school-resume/fetch_course/${id}') }}`,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                if (resp.success) {
                    $('#course_model .course_title').text('Edit Model');
                    $('#course_name').val(resp.educationCourse.name);
                    $('#course_type').val(resp.educationCourse.course_type);
                    $('#course_model .modal_submit_btn').attr('data-id',resp.educationCourse.id);
                    $('#course_model .modal_submit_btn').text('Update');
                    $('#course_model .modal_submit_btn').attr('onclick','update_course(this);return false;');
                    $('#course_model').modal('show');
                }
            },
            error: function(err) {
                console.log("err =>>>", err);
            }
        });
    }

    function update_course(data) {
        let id = $(data).attr('data-id');
        let course_name = $('#course_name').val();
        let course_type = $('#course_type').val();

        if(course_name == ""){
            toastr.error("please select a course");
            return false;
        }

        if(course_type == ""){
            toastr.error("please select a course type");
            return false;
        }

        $.ajax({
            url: `{{ url('/admin/high-school-resume/update_course/${id}') }}`,
            type: "PUT",
            dataType: "JSON",
            data: {
                "_token": "{{  csrf_token() }}",
                "course_name": course_name,
                "course_type": course_type
            },
            success: function(resp) {
                if (resp.success) {
                    fetch_all_courses();
                    $('#course_name').val("");
                    $('#course_type').val("");
                    $('#course_model').modal('hide');
                    toastr.success(resp.message);
                }
            },
            error: function(err) {
                console.log("err =>>>", err);
            }
        });
    }

    function delete_course(data) {
        let id = $(data).attr('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to delete this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ url('/admin/high-school-resume/delete_course/${id}') }}`,
                    type: "DELETE",
                    dataType: "JSON",
                    data: {
                        "_token": "{{  csrf_token() }}",
                    },
                    success: function(resp) {
                        if (resp.success) {
                            fetch_all_courses();
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

    function fetch_all_courses() {
        $.ajax({
            url: `{{ url('/admin/high-school-resume/fetch_all_course') }}`,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                if (resp.success) {
                    $('#courses_table tbody').html('');
                    let html = ``;
                    if(resp.education_courses && resp.education_courses.length > 0){
                        $.each(resp.education_courses, function(index, education_course){
                            html += `<tr class="remove_course_${education_course.id}">`;
                            html += `<td class="fw-semibold fs-sm">${education_course.id}</td>`;
                            html += `<td class="course_name">${education_course.name}</td>`;
                            html += `<td class="course_type">${education_course.course_type == 1 ? 'IB Course' : 'AP Course'}</td>`;
                            html += `<td>`;
                            html += `<div class="btn-group">`;
                            html += `<button class="btn btn-sm btn-alt-primary" data-bs-toggle="tooltip" title="Edit Section" data-id="${education_course.id}" onclick="edit_courses(this)">`;
                            html += `<i class="fa fa-fw fa-pencil-alt"></i>`;
                            html += `</button>`;
                            html += `<button type="button" class="btn btn-sm btn-alt-danger ms-2" data-bs-toggle="tooltip" data-id="${education_course.id}" title="Delete Section" onclick="delete_course(this)">`;
                            html += `<i class="fa fa-fw fa-trash"></i>`;
                            html += `</button>`;
                            html += `</div>`;
                            html += `</td>`;
                            html += `</tr>`;
                        });
                    } else {
                        html += `<tr>`;
                        html += `<td colspan="4" class="text-center">No Course Found</td>`;
                        html += `</tr>`;
                    }
                    $('#courses_table tbody').append(html);
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