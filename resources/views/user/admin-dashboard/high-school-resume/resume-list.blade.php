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
                                            <button class="btn btn-sm" data-toggle="modal"
                                                data-target=".bd-example-modal-lg" data-bs-toggle="tooltip" title="Preview">
                                                <i class="fa fa-fw fa-file-pdf"></i>
                                            </button>
                                            <a href="{{ route('admin-dashboard.highSchoolResume.resume.download', ['id' => $resume->id, 'type' => 'download']) }}"
                                                class="btn btn-sm ms-2" data-bs-toggle="tooltip" title="Download">
                                                <i class="fa fa-fw fa-download"></i>
                                            </a>
                                            <form id="deleteResumeForm" onsubmit="deleteResume(this)"
                                                data-id="{{ $resume->id }}">
                                                <button type="submit" class="btn btn-sm ms-2" data-bs-toggle="tooltip"
                                                    title="Delete">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
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
    <div class="modal fade bd-example-modal-lg" id="myLargeModalLabel" role="dialog"
        aria-labelledby="modal-block-extra-large" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-preview text-border rounded-0">
                        <div class="">
                            <h1><span>Carl </span> Crawford</h1>
                        </div>
                        <div class="block-options">
                            <button type="button" class="btn-block-option close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-padding custom-tab-container block-content fs-sm">
                        <div class="row">
                            <div class="col-lg-4 preview-border">
                                <div class="preview-leftside">
                                    <div class="preview-list mb-3">
                                        <h3>Contact</h3>
                                        <ul class="list">
                                            <li>judafabesy@mailinator.com</li>
                                            <li>+1 (324) 606-7351</li>
                                            <li>19 South New Road</li>
                                            <li>Debitis in autem ver</li>
                                            <li>11200</li>
                                            <li>Sunt omnis veniam p, Ex quisquam pariatur</li>
                                        </ul>
                                    </div>
                                    <div class="preview-list mb-3">
                                        <h3>Featured Skills</h3>
                                        <ul class="list">
                                            <li>Amet dolore tempori</li>
                                        </ul>
                                    </div>
                                    <div class="preview-list mb-3">
                                        <h3>featured awards</h3>
                                        <ul class="list">
                                            <li>Qui lorem modi delen</li>
                                        </ul>
                                    </div>
                                    <div class="preview-list mb-3">
                                        <h3>featured languages</h3>
                                        <ul class="list">
                                            <li>Voluptatibus possimu</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="preview-rightside">
                                    <div class="preview-list mb-3">
                                        <h3>Education</h3>
                                        <ul class="list">
                                            <li>Reed Murphy / Qui neque repellendu / Molestiae velit proi</li>
                                            <li>Weighted GPA: Dolorem ullamco eius, Class Rank: Ab eum enim aspernat
                                            </li>
                                            <li>
                                                <span>Name of Test:</span>Uma Hale
                                            </li>
                                            <li>
                                                <span>IB Courses:</span>list 5
                                            </li>
                                            <li>
                                                <span>AP Courses:</span> list 2, list 3, list 4, list 5
                                            </li>
                                            <li>
                                                <span>Honors Courses:</span> Hayden Johnston
                                            </li>
                                            <li>
                                                <span>Concurrent Courses:</span> Brittany Harrison
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="preview-list mb-3">
                                        <h3>Activities</h3>
                                        <ul class="list">
                                            <li>
                                                <span>Intended College Major(s):</span>
                                                Demo
                                            </li>
                                            <li>
                                                <span>Intended College Minor(s):</span>Temp
                                            </li>
                                            <li>
                                                <span>Demostrated Interests in the Area of my College
                                                    Major:</span>Vel qui tenetur non
                                            </li>
                                            <li>
                                                <span>Leadership:</span> Washington and Rich LLC
                                            </li>
                                            <li>
                                                <span>Athletics:</span> Ullam eligendi sequi
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="preview-list mb-3">
                                        <h3>Employment</h3>
                                        <ul class="list">
                                            <li> Non et sapiente maio </li>
                                        </ul>
                                    </div>
                                    <div class="preview-list mb-3">
                                        <h3>Certifications</h3>
                                        <ul class="list">
                                            <li> Ab recusandae Duis </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Resume-list Modal -->

@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}">
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/high-school-resume.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <script>
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
                    let id = $('#deleteResumeForm').attr('data-id');
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
        });

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
