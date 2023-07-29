@extends('layouts.user')

@section('title', 'HSR | List : CPS')

@section('user-content')
@can('Access Reminders')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>
                    <h1 class="h2 mb-0">Reminders</h1>
                    <br>
                </div>
            </div>
        </div>

        <div class="block-rounded">
            <div class="block-content">
                <div class="block-header tbl-header block-header-default">
                    <div class="block-title">
                        Reminders
                    </div>
                </div>
                <div class="block-content bg-white pb-4">
                    <div class="mb-5">
                        <h4 class="fw-normal border-bottom pb-2 mb-3">Global Notification</h4>
                        <div class="mb-2">
                            <div class="space-x-1">
                                <input class="form-check-input user-settings" type="checkbox" value="" id="is_receive_sms" name="is_receive_sms" @if($user_settings->is_receive_sms) checked @endif>
                                <label class="form-check-label fw-bold" for="is_receive_sms">Received SMS</label>
                            </div>
                            <div class="fw-light fs-6 text-muted">Enables or disables all columns Received SMS</div>
                        </div>
                        <div class="mb-2">
                            <div class="space-x-1">
                                <input class="form-check-input user-settings" type="checkbox" value="" id="application_deadline_notification" name="application_deadline_notification" @if($user_settings->application_deadline_notification) checked @endif>
                                <label class="form-check-label fw-bold" for="application_deadline_notification">Application Deadline Reminders</label>
                            </div>
                            <div class="fw-light fs-6 text-muted">Enables or disables all columns deadline reminders</div>
                        </div>
                        <div class="mb-2">
                            <div class="space-x-1">
                                <!-- <input class="form-check-input user-settings" type="checkbox" value="" id="application_deadline_notification" name="application_deadline_notification" @if($user_settings->application_deadline_notification) checked @endif> -->
                                <label class="form-check-label fw-bold" for="timezone">Timezone</label>
                                <div class="row m-0">
                                    <div class="col-12 col-md-3 p-0">
                                        <select class="js-example-basic-single form-control user-settings" id="timezone" name="timezone" data-placeholder="Select One.">
                                            <option></option>
                                            @foreach(config('timezone') as $option) 
                                                <option value="{{ $option['tzCode'] }}" @if($user_settings->timezone == $option['tzCode']) selected @endif >{{ $option['label'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="fw-light fs-6 text-muted">To get reminders at the right time in your timezone</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h4 class="fw-normal border-bottom pb-2 mb-3">Custom Notification</h4>
                        <table class="table table-bordered table-vcenter" id="reminderTable">
                            <thead>
                                <tr class="tbl-header">
                                    <th class="text-center" >Reminder Name</th>
                                    <th class="text-center" >Type</th>
                                    <th class="text-center" >Frequency</th>
                                    <th class="text-center" >Method</th>
                                    <th class="text-center">Location</th>
                                    <th class="text-center" >When</th>
                                    <th class="text-center">Before Time</th>
                                    <th class="text-center">Before Frequency</th>
                                    <th class="text-center" >Starts</th>
                                    <th class="text-center" >End</th>
                                    <th class="text-center">Enabled</th>
                                    <th class="text-center" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form class="js-validation" id="reminder_form" action="{{ route('user.reminders.submit') }}" method="POST" >
                                    @csrf
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control @error('reminder_name') is-invalid error @enderror" id="reminder_name" name="reminder_name" placeholder="Name of Reminder" autocomplete="_off" value="{{ old('reminder_name') ? old('reminder_name') : '' }}" >
                                            @error('reminder_name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="js-select2 form-select single-select2-class @error('reminder_type_id') is-invalid error @enderror" name="reminder_type_id" id="reminder_type_id" style="width: 100%;" data-placeholder="Select Type" multiple="multiple"  >
                                                <option value="">Select Type</option>
                                                @foreach($reminderTypes as $reminderType)
                                                    <option value="{{ $reminderType->id}}" {{ old('reminder_type_id') == $reminderType->id ? 'selected' : '' }}>{{$reminderType->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('reminder_type_id')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="js-select2 form-select @error('frequency') is-invalid error @enderror" name="frequency" id="frequency" style="width: 100%;" data-placeholder="Select frequency"  >
                                                <option value="">Select</option>
                                                @foreach($reminders_frequency as $key => $frequency)
                                                    <option value="{{ $frequency }}" @if(old('frequency') == $frequency) selected @endif> {{ $frequency }} </option>
                                                @endforeach
                                            </select>
                                            @error('frequency')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="js-select2 form-select @error('method') is-invalid error @enderror" name="method" id="method" style="width: 100%;" data-placeholder="Select method"  >
                                                <option value="">Select</option>
                                                @foreach ($methods as $method)
                                                    <option value="{{ $method }}" @if(old('method') == $method) selected @endif>{{ $method }}</option>
                                                @endforeach
                                            </select>
                                            @error('method')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="form-control @error('location') is-invalid error @enderror" id="location" name="location" placeholder="location" value="{{ old('location') ? old('location') : '' }}">
                                            @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="custom-flatpickr-time form-control @error('when_time') is-invalid error @enderror" id="when_time" name="when_time" placeholder="When Time" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" value="{{ old('when_time') ? old('when_time') : '' }}">
                                            @error('when_time')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="form-control @error('before_time') is-invalid error @enderror" id="before_time" name="before_time" placeholder="Before Time" value="{{ old('before_time') ? old('before_time') : '' }}">
                                            @error('before_time')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="form-select @error('before_frequncy') is-invalid error @enderror" name="before_frequncy" id="before_frequncy" style="width: 100%;" data-placeholder="Select Before frequency">
                                                <option value="">Select</option>
                                                @foreach(config('constants.reminder_brefore_frequncy') as $key => $frequency)
                                                    <option value="{{ $frequency }}" @if(old('before_frequncy') == $frequency) selected @endif> {{ $frequency }} </option>
                                                @endforeach
                                            </select>
                                            @error('before_frequncy')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="js-flatpickr form-control error @error('start_date') is-invalid @enderror" id="start_date" name="start_date" placeholder="Start Date" value="{{ old('start_date') ? old('start_date') : '' }}">
                                            @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="js-flatpickr form-control @error('end_date') is-invalid error @enderror" id="end_date" name="end_date" placeholder="End Date" value="{{ old('end_date') ? old('end_date') : '' }}">
                                            @error('end_date')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td class="text-center">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="checkbox" name="enabled" id="enabled" value="1">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <button type="submit" class="btn btn-sm btn-primary" style="width: 70px;">Submit</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </form>
                                @foreach ($reminders as $reminder)
                                <form class="js-validation" id="reminder_form_{{ $reminder->id }}" action="{{ route('user.reminders.update', ['id' => $reminder->id]) }}" method="PUT" >
                                    @csrf
                                    <tr class="reminder_remove_{{ $reminder->id }}">
                                        <td>
                                            <input type="text" class="form-control" id="reminder_name_{{ $reminder->id }}" name="reminder_name_{{ $reminder->id }}" placeholder="Name of Reminder" value="{{ $reminder->reminder_name }}" autocomplete="_off" >
                                        </td>
                                        <td>
                                            <select class="js-select2 form-select single-select2-class" name="reminder_type_id_{{ $reminder->id }}" id="reminder_type_id_{{ $reminder->id }}" style="width: 100%;" data-placeholder="Select Type" multiple="multiple" >
                                                <option value="">Select Type</option>
                                                @foreach($reminderTypes as $reminderType)
                                                    <option value="{{ $reminderType->id}}" @if($reminderType->id == $reminder->reminder_type_id) selected @endif>{{$reminderType->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="js-select2 form-select" name="frequency_{{ $reminder->id }}" id="frequency_{{ $reminder->id }}" style="width: 100%;" data-placeholder="Select frequency" >
                                                <option value="">Select</option>
                                                @foreach($reminders_frequency as $key => $frequency)
                                                    <option value="{{ $frequency }}" @if($frequency == $reminder->frequency) selected @endif> {{ $frequency }} </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="js-select2 form-select" name="method_{{ $reminder->id }}" id="method_{{ $reminder->id }}" style="width: 100%;" data-placeholder="Select method" >
                                                <option value="">Select</option>
                                                @foreach ($methods as $method)
                                                    <option value="{{ $method }}" @if($method == $reminder->method) selected @endif>{{ $method }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control @error('location') is-invalid error @enderror" id="location_{{ $reminder->id }}" name="location_{{ $reminder->id }}" placeholder="location" value="{{ $reminder->location }}">
                                            @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="custom-flatpickr-time form-control" id="when_time_{{ $reminder->id }}" name="when_time_{{ $reminder->id }}"  data-enable-time="true" data-no-calendar="true" value="{{ $reminder->when_time }}" >
                                        </td>
                                        <td>
                                            <input type="text" class="form-control @error('before_time') is-invalid error @enderror" id="before_time_{{ $reminder->id }}" name="before_time_{{ $reminder->id }}" placeholder="Before Time" value="{{ $reminder->before_time }}">
                                            @error('before_time')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <select class="form-select @error('before_frequncy') is-invalid error @enderror" name="before_frequncy_{{ $reminder->id }}" id="before_frequncy_{{ $reminder->id }}" style="width: 100%;" data-placeholder="Select Before frequency">
                                                <option value="">Select</option>
                                                @foreach(config('constants.reminder_brefore_frequncy') as $key => $frequency)
                                                    <option value="{{ $frequency }}" @if($reminder->before_frequncy == $frequency) selected @endif> {{ $frequency }} </option>
                                                @endforeach
                                            </select>
                                            @error('before_frequncy')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" class="js-flatpickr form-control" id="start_date_{{ $reminder->id }}" name="start_date_{{ $reminder->id }}" value="{{ $reminder->start_date }}" >
                                        </td>
                                        <td>
                                            <input type="text" class="js-flatpickr form-control" id="end_date_{{ $reminder->id }}" name="end_date_{{ $reminder->id }}" value="{{ $reminder->end_date }}" >
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="enabled_{{ $reminder->id }}" id="enabled_{{ $reminder->id }}" value="1" {{ $reminder->enabled == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-sm btn-primary" style="width: 70px;">Save</button>
                                            <a class="btn btn-sm ms-2" data-bs-toggle="tooltip" title="Delete" id="{{$reminder->id}}" onclick="deleteReminder({{$reminder->id}})">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </form>
                                @endforeach
                
                                {{-- onSubmit="event.preventDefault();" --}}
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
@endcan

@cannot('Access Reminders')
    @include('components.subscription-warning')
@endcan

@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/college-application-deadline.css') }}">
    <link rel="stylesheet" href="{{ asset('css/collegeExploration.css') }}">

    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

    <style>
        .form-control.is-invalid, .was-validated .form-control:invalid {
            border-color: #dc2626 !important;
        }
        .btn:focus {
            box-shadow: none
        }
        .table tbody tr:nth-child(1) td{
            padding: 10px 30px 10px 30px;
        }
        .swal2-styled.swal2-default-outline:focus {
            box-shadow: none;
        }
        .swal2-icon.swal2-warning {
            border-color: #f27474;
            color: #f27474;
        }
        .select2-container_main-position{
            display: block;
        }
        .select2-container_main-position .error{
            position: absolute;
            top: 50px;
            left: 0;
        }

        .select2-container--default .select2-selection--multiple,
        .select2-container--default .select2-selection--single {
            border: 1px solid #dfe3ea !important;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove,
        .select2-hidden-accessible {
            color: #232d3a;
            position: absolute;
            top: -2px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display,
        .select2-hidden-accessible {
            color: #1f2937 !important;
        }

        .select2-container .select2-selection--single {
            height: 35px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            margin-top: 2px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #7b838a !important;
        }
        .select2-container .select2-dropdown {
            z-index: 999999;
        }
        .select.is-invalid+.select2-container .selection .select2-selection {
            border-color: #dc2626 !important;
        }

        .valid > .select2-container--default .select2-selection--multiple {
            border: 1px solid #198754 !important;
            box-shadow: none !important;
        }

        .error+.select2-container--default .select2-selection--multiple , 
        .error+.select2-container--default .select2-selection--single{
            /* border: 1px solid #f27474 !important;
            box-shadow: 0 0 0 0.25rem rgb(220 38 38 / 25%); */
            border-color: #dc2626 !important;
        }

        .select2-container_main {
            position: relative;
        }

        .select2-container_main .error {
            position: absolute;
            top: 73px;
            left: 0;
        }

        .error>.select2-container_main {
            margin-bottom: 20px;
        }
        .select2-container .select2-search--inline .select2-search__field {
            margin-top: 8px;
            margin-left: 10px;
        }
        .select2-container {
            width: 100% !important;
        }
        .select2-container .select2-selection--multiple {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            min-height: 37px !important;
            user-select: none;
            -webkit-user-select: none;
        }

        .tbl-header {
            background: #1f2937;
            color: #fff;
        }
    </style>
@endsection

@can('Access Reminders')
@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

    <script src="{{asset('assets/js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/js/moment/moment.min.js')}}"></script>
    <script>One.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);</script>
    <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>

    <script>
        $('.js-example-basic-single').select2({
            placeholder: 'Select an option',
            // allowClear: true
        });

        $(".custom-flatpickr-time").flatpickr({
            enableTime: true,
            dateFormat: "h:i",
            minuteIncrement: 15,
            onReady: function (selectedDates, dateStr, instance) {
                if (dateStr) {
                    const time = moment(selectedDates[0]).format('hh:mm A');
                    instance.element.value = time;
                }
            },
            onChange: function (selectedDates, dateStr, instance) {
                let minutes = selectedDates[0].getMinutes();
                let hours = selectedDates[0].getHours();
                if (minutes % 15 !== 0) {
                    minutes = Math.round(minutes / 15) * 15;
                    if (minutes == 60) {
                        hours = hours + 1;
                    }
                    selectedDates[0].setMinutes(minutes);
                    selectedDates[0].setHours(hours);
                    instance.setDate(selectedDates[0]);
                }
                const time = moment(selectedDates[0]).format('hh:mm A');
                instance.element.value = time;
            }
        });
        function deleteReminder(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to recover this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(48 133 214)',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('/user/reminders-delete/${id}') }}`,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(resp) {
                            if (resp.success) {
                                $(`#reminderTable .reminder_remove_${resp.id}`).remove();
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

        
        $(document).ready(function() {
            $('.single-select2-class').select2({
                maximumSelectionLength: 1,
                tags: true,
                language: {
                    maximumSelected: function () {
                        return '';
                    }
                }
            }).on('select2:opening', function (event) {
                var selectedOptions = $(this).val();
                if (selectedOptions && selectedOptions.length >= 1) {
                    event.preventDefault();
                }
            });
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
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        $('.user-settings').on('change', function (e) {
            const data = {};
            if (e.target.type == 'checkbox') {
                data[e.target.name] = e.target.checked ? 1 : 0;
            } else {
                data[e.target.name] = e.target.value;
            }
            $.ajax({
                url: "{{ route('update-user-settings') }}",
                method: "PATCH",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }).done((response) => {
                if (response.success) {
                    toastr.success(response.message);
                } else {
                    $('#' + e.target.id).prop('checked', e.target.checked ? false : true);
                    toastr.error(response.message);
                }
            })
        })
    </script>
@endsection
@endcan
