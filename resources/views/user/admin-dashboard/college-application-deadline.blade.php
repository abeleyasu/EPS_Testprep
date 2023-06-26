@extends('layouts.user')

@section('title', 'College Application DeadLine : CPS')

@section('user-content')
<main id="main-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column justify-content-center">
                <h1 class="h3 mb-3">College Application Deadline Organizer</h1>
                <span>
                    <button type="button" class="btn btn-inform" data-bs-toggle="popover" data-bs-placement="bottom" title="" data-bs-content="This is example content. You can put a description or more info here." data-bs-original-title="Bottom Popover">Instructions</button>
                </span>
            </div>
        </div>
    </div>
    <div class="block block-rounded college-application-wrapper">
        <div class="block-header block-header-default block-header-main">
            <h3 class="block-title">COLLEGE LIST & APPLICATION DEADLINES</h3>
        </div>
        <div class="block-content">
            @if(count($college_list_deadline) > 0)
                <button type="reset" class="btn btn-sm btn btn-alt-success mb-3" data-bs-toggle="modal" data-bs-target="#add_new_college">+ Add College</button>
                <button type="button" class="btn btn-sm btn-alt-success mb-3 ms-2" id="view-hide-college-btn">View Hidden Colleges</button>
            @endif
            <p>
                <span class="note-text">Note:</span> Adding or removing a college from this list will also add it to or remove it from all tools on your profile, including the My College List tool.
            </p>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="tab-content" id="myTabContent">
                <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
                    <div class="accordion accordionExample accordionExample2" id="application-organizer-list">

                        @if(count($college_list_deadline) === 0)
                            <div class="no-data">No data found</div>
                        @endif  
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="add_new_college" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header colleg-add-header">
                    <h3 class="block-title">Add College</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="row block-content">
                    <div>
                        <label for="college" class="form-label">Select College</label>
                        <select class="js-data-example-ajax form-control" id="college" name="college" style="width: 100%;" data-placeholder="Select One.">
                            <option value="">Select One</option>
                        </select>
                    </div>
                </div>
                <div class="block-content block-content-full text-end">
                    <button type="button" class="btn btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn submit-btn" id="add-college">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hide-college-list-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">College List</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="hide-college-modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/college-application-deadline.css') }}">
<link rel="stylesheet" href="{{ asset('css/collegeExploration.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<style>
    .no-data {
        border: 1px solid;
        border-style: dashed;
        border-color: darkgray;
        padding: 10px;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
    }

    .college-content {
        padding: 10px 20px;
    }

    .list-content {
        display: flex;
        align-items: center;
    }

    .colleg-add-header {
        background: #1f2937;
        color: #fff;
    }

    .block-content {
        padding: 15px;
    }
</style>
@endsection

@section('user-script')
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{asset('js/college-list.js')}}"></script>
<script src="{{asset('js/college-application-organizer.js')}}"></script>
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    One.helpersOnLoad(['one-table-tools-checkable', 'one-table-tools-sections']);

    const staticdata = {
        applications: @json($applications),
        admision_option: @json($admision_option),
        college_list_status: @json($college_list_status),
    }

    $('#myTabContent').on('show.bs.collapse', async function (e) {
        console.log(e)
        console.log('called')
        if (e.target.tagName != 'INPUT') {
            await getSingleApplicationData(e.target.dataset, staticdata, e.target.id)
        }
    })

    $('#myTabContent').on('hidden.bs.collapse', function (e) {
        const id = e.target.dataset.id;
        $('#toggle' + id).removeClass('fa-angle-down').addClass('fa-angle-right');
        $('#' + e.target.id).html('')
    })

    $('.chagecollagecheckbox').on('change', function (e) {
        const id = e.target.id
        $('#is_complete_application_type-' + id).attr('checked', e.target.checked);
        $('#is_complete_admission_open-' + id).attr('checked', e.target.checked);
        $('#is_completed_css_profile_deadlineon_open-' + id).attr('checked', e.target.checked);
        $('#is_complete_number_of_essays-' + id).attr('checked', e.target.checked);
        $('#is_complete_admission_deadline-' + id).attr('checked', e.target.checked);
        $('#is_complete_competitive_scholarship_deadline-' + id).attr('checked', e.target.checked);
        $('#is_complete_scholarship_deadline-' + id).attr('checked', e.target.checked);
        $('#is_completed_honors_college_deadline-' + id).attr('checked', e.target.checked);
        $('#is_completed_fafsa_deadline-' + id).attr('checked', e.target.checked);
        $.ajax({
            url: "{{ route('admin-dashboard.set_application_completed') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                is_completed_all_process: e.target.checked ? 1 : 0,
                ...e.target.dataset
            }
        }).done(function(data){
            // window.location.reload();
        });
    })

    $(document).on('change', '.application_checklist', function (e) {
        const id = e.target.id;
        const currentIndex = id.split('-')[1];
        const applications = document.querySelectorAll('.application-' + currentIndex);
        applications.forEach((application) => {
            application.checked = e.target.checked;
            application.value = e.target.checked ? 1 : 0;
        })
        $('#' + id).attr('checked', e.target.checked);
        $('#' + id).val(e.target.checked ? 1 : 0);
        saveform(currentIndex);
    })

    $(document).on('change', '.status', function (e) {
        const id = e.target.id;
        $('#' + id).val(e.target.checked ? 1 : 0);
    })

    $(document).ready(function() {
        const errors = {{ $errors->count() }};
        if(errors > 0) {
            $('#add_new_college').modal('show');
        }

        getApplicationDeadlineOrganizerData();
    });

    $(document).on('change', '.app-checklist', function (e) {
        const elementIndex = $(this).data('index');
        // console.log('elementIndex -->', elementIndex)
        $.each($('.application-' + elementIndex), function (index, value) {
            // console.log('checked -->', value.checked)
            if (!value.checked) {
                $('#is_application_checklist-' + elementIndex).attr('checked', false);
                $('#is_application_checklist-' + elementIndex).val(0);
                return false;
            }
            $('#is_application_checklist-' + elementIndex).attr('checked', true);
            $('#is_application_checklist-' + elementIndex).val(1);
        })
        setTimeout(() => {
            saveform(elementIndex);
        }, 500);
    })

    $('#view-hide-college-btn').on('click', async function (e) {
        await getHideCollegeList('hide-college-list-modal')
    })

    $(document).on('click', '.show-college-from-list', async function (e) {
        const response = await hideshowlist(e.target.dataset.id);
        if (response) {
            await getHideCollegeList('hide-college-list-modal')
            await getApplicationDeadlineOrganizerData();
        }
    })

    $(document).on('click', '.hide-college-from-list', function (e) {
        Swal.fire({
        title: 'Are you sure?',
        text: "You want to hide this college?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, hide it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then(async (result) => {
        if (result.isConfirmed) {
            const response = await hideshowlist(e.target.dataset.id);
            if (response) {
                await getApplicationDeadlineOrganizerData();
            }
        }
        })
    })

    $(document).on('click', '.save-detail', function (e) {
        e.preventDefault();
    })

    function saveform(formid) {
        $.ajax({
            url: "{{route('admin-dashboard.college_application_save')}}",
            type: 'POST',
            data: $('#form-' + formid).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(async (response) => {
            if (response.success) {
                if ($('#is_application_checklist-' + formid).val() == 1) {
                    $('#block-header-' + formid).addClass('bg-success');
                } else {
                    $('#block-header-' + formid).removeClass('bg-success');
                }
                // toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
        })
    }


    $(document).on('change', '.update-form', function (e) {
        saveform(e.target.dataset.index);
    })

    $(document).on('click', '#add-college', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('admin-dashboard.collegeApplicationDeadline.college_save') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {college: $('#college').val()},
        }).done(async (response) => {
            if (response.success) {
                toastr.success(response.message)
                window.localStorage.setItem('APP-REFRESHED', Date.now());
                $("#college").empty();
                $('#add_new_college').modal('hide')
                await getApplicationDeadlineOrganizerData();
            } else {
                toastr.error(response.message)
            }
        })
    })
</script>
@endsection