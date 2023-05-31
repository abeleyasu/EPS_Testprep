@extends('layouts.user')

@section('title', 'HSR | List : CPS')

@section('user-content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('assets/cpsmedia/BlackboardImage.jpg');">
            <div class="bg-black-10">
                <div class="content content-full text-center">
                    <br>
                    {{-- text-white --}}
                    <h1 class="h2 mb-0">Reminders</h1>
                    <br>
                </div>
            </div>
        </div>

        <div class="">{{-- content --}}
            <div class="block block-rounded reminder-list-table">
                <div class="block-content">
                    <div class="table-responsive" style="width: 100%; overflow: auto;">
                        <table class="table table-bordered table-striped table-vcenter" id="reminderTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="min-width: 200px;">Reminder Name</th>
                                    <th class="text-center" style="min-width: 300px;">Type</th>
                                    <th class="text-center" style="min-width: 170px;">Frequency</th>
                                    <th class="text-center" style="min-width: 160px;">Method</th>
                                    <th class="text-center" style="min-width: 130px;">When</th>
                                    <th class="text-center" style="min-width: 180px;">Starts</th>
                                    <th class="text-center" style="min-width: 180px;">End</th>
                                    <th class="text-center">Enabled</th>
                                    <th class="text-center" style="min-width: 180px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                            <input type="text" class="js-flatpickr form-control" id="when_time_{{ $reminder->id }}" name="when_time_{{ $reminder->id }}"  data-enable-time="true" data-no-calendar="true" data-date-format="H:i" value="{{ $reminder->when_time }}" >
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
                                        <td class="justify-content-between">
                                            <button type="submit" class="btn btn-sm btn-primary" style="width: 70px;">Save</button>
                                            <a class="btn btn-sm ms-2" data-bs-toggle="tooltip" title="Delete" id="{{$reminder->id}}" onclick="deleteReminder({{$reminder->id}})">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </form>
                                @endforeach

                                {{-- onSubmit="event.preventDefault();" --}}
                                <form class="js-validation" id="reminder_form" action="{{ route('user.reminders.submit') }}" method="POST" >
                                    @csrf
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control @error('reminder_name') is-invalid error @enderror" id="reminder_name" name="reminder_name" placeholder="Name of Reminder" autocomplete="_off" value="{{ old('reminder_name') ? old('reminder_name') : '' }}" >
                                                    @error('reminder_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
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
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
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
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
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
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="js-flatpickr form-control @error('when_time') is-invalid error @enderror" id="when_time" name="when_time" placeholder="When Time" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" value="{{ old('when_time') ? old('when_time') : '' }}">
                                                    @error('when_time')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="js-flatpickr form-control error @error('start_date') is-invalid @enderror" id="start_date" name="start_date" placeholder="Start Date" value="{{ old('start_date') ? old('start_date') : '' }}">
                                                    @error('start_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="js-flatpickr form-control @error('end_date') is-invalid error @enderror" id="end_date" name="end_date" placeholder="End Date" value="{{ old('end_date') ? old('end_date') : '' }}">
                                                    @error('end_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr/toastr.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/high-school-resume.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

    <style>
        .reminder-list-table {
            background: #fff;
            box-shadow: 0 0 10px rgb(183 183 183 / 45%);
            margin: 26px 0;
            border-radius: 15px !important;
        }
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

        table,
        th,
        td {
            border: none;
        }

        ul,
        li {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .nav-tabs {
            border: 0;
        }

        p {
            margin-bottom: 0;
        }

        .table-responsive td,
        .table-responsive th {

            padding: 10px 30px 10px 30px;
        }
        .table tbody tr:nth-child(1) td {
            padding: 0;
        }
    </style>
@endsection

@section('user-script')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

    <script src="{{asset('assets/js/plugins/flatpickr/flatpickr.min.js')}}"></script>
    <script>One.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);</script>

    <script>
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
    </script>
@endsection
