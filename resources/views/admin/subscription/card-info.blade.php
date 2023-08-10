@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('page-style')
  <!-- Stylesheets -->
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
@endsection

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
  <div class="content">
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-error">
        {{ session('error') }}
      </div>
    @endif
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">User {{ $subscription['plan_type'] == 'subscription' ? 'Subscription' : 'Payment' }} Infroamtion</h3>
      </div>
      <div class="block-content block-content-full">

        @if ($subscription['plan_type'] == 'one-time')

        @if($subscription['pending_consumed_hours'] > 0)
        <div class="text-end mb-1">
          <button class="btn btn-alt-success" data-bs-toggle="modal" data-bs-target="#add-consumed-details">Add Consumed Hour</button>
        </div>
        @endif
        
        <table id="payment-consumed-hours" class="table table-bordered table-striped table-vcenter">
          <thead>
            <tr>
              <th>id</th>
              <th style="width: 15%">Consumed Type</th>
              <th style="width: 15%">Consumed hours</th>
              <th style="width: 20%">Date</th>
              <th style="width: 40%">Note</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
        @endif

        <table class="table table-bordered">
          <tr align="center">
            <td colspan="2" class="fw-bold">{{ $subscription['plan_type'] == 'subscription' ? 'Subscription' : 'Payment' }} Details:</td>
          </tr>
          <tr>
            <th>Product Name:</th>
            <td>{{ $subscription['plan']['product']['title'] }}</td>
          </tr>
          <tr>
            <th>{{ $subscription['plan_type'] == 'subscription' ? 'Subscription' : 'Payment' }} Id:</th>
            <td>{{ $subscription['stripe_id'] }}</td>
          </tr>
          <tr>
            <th>Subscription Amount:</th>
            <td>{{ $subscription['plan']['amount'] }}</td>
          </tr>
          <tr>
            <th>Subscription End Date:</th>
            <td>
              @if($subscription['plan_type'] == 'subscription')
                {{ $subscription['ends_at'] }}
              @elseif ($subscription['plan_type'] == 'one-time')
                @if($subscription['ends_at'])
                  {{ $subscription['ends_at'] }}
                @else
                  {{ $subscription['plan_end_date'] }}
                @endif
              @endif
            </td>
          </tr>
          <tr>
            <th>Subscription Start Date:</th>
            <td>{{ $subscription['created_at'] }}</td>
          </tr>
          @if($subscription['plan_type'] == 'subscription' && !$subscription['is_auto_renewal'])
          <tr>
            <th>Next deduction amount:</th>
            <td>{{ $subscription['plan']['amount'] }}</td>
          </tr>
          <tr>
            <th>Next Amount deduct date:</th>
            <td>{{ $subscription['next_billing_date'] }}</td>
          </tr>
          @else
          <tr>
            <th>Total Pending Hours:</th>
            <td id="total-pending-hours">{{ $subscription['pending_consumed_hours'] }}</td>
          </tr>
          @endif
          <tr>
            <th>Subscription Status:</th>
            @php 
              $classname = 'bg-success-light text-success';
              if ($subscription['stripe_status'] === 'failed') {
                $classname = 'bg-danger-light text-danger';
              } else if ($subscription['stripe_status'] === 'consumed' || $subscription['stripe_status'] === 'canceled') {
                $classname = 'bg-warning-light text-warning';
              }
            @endphp
            <td><span class="fs-sm fw-medium rounded text-center p-1 {{ $classname  }}" id="status">{{ $subscription['stripe_status'] }}</span></td>
          </tr>
          <tr align="center">
            <td colspan="2" class="fw-bold">Billing Details:</td>
          </tr>
          <tr>
            <th>Card Holder name:</th>
            <td>{{ $subscription['card']['billing_details']['name'] }}</td>
          </tr>
          <tr>
            <th>User Email:</th>
            <td>{{ $subscription['card']['billing_details']['email'] }}</td>
          </tr>
          <tr>
            <th>User Phone Number:</th>
            <td>{{ $subscription['card']['billing_details']['phone'] }}</td>
          </tr>
          <tr>
            <th>User State:</th>
            <td>{{ $subscription['card']['billing_details']['address']['state'] }}</td>
          </tr>
          <tr>
            <th>User City:</th>
            <td>{{ $subscription['card']['billing_details']['address']['city'] }}</td>
          </tr>
          <tr>
            <th>User Address line 1:</th>
            <td>{{ $subscription['card']['billing_details']['address']['line1'] }}</td>
          </tr>
          <tr>
            <th>User Address line 2:</th>
            <td>{{ $subscription['card']['billing_details']['address']['line2'] }}</td>
          </tr>
          <tr>
            <th>User Postal Code:</th>
            <td>{{ $subscription['card']['billing_details']['address']['postal_code'] }}</td>
          </tr>
          <tr>
            <th>Card Number (Last 4 digit):</th>
            <td>{{ $subscription['card']['card']['last4'] }}</td>
          </tr>
          <tr>
            <th>Card Expiration Date:</th>
            <td>{{ $subscription['card']['card']['exp_month'] }}/{{ $subscription['card']['card']['exp_year'] }}</td>
          </tr>
          <tr>
            <th>Card Brand:</th>
            <td>{{ $subscription['card']['card']['brand'] }}</td>
          </tr>
          <tr>
            <th>Card Country:</th>
            <td>{{ $subscription['card']['card']['country'] }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</main>
<div class="modal fade" id="add-consumed-details" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add-consumed-details-label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add-consumed-details-label">Enter User Subscription Consumed Hours Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add-form">
          @csrf
          <div class="mb-2">
            <label for="consumed_type" class="form-label">Consumed Type</label>
            <select class="form-select" id="consumed_type" name="consumed_type">
              <option value="minute">Minute</option>
              <option value="hour">Hour</option>
            </select>
          </div>
          <div class="row mb-2">
            <div class="col-6">
              <label for="hours" class="form-label">Enter Minute</label>
              <input type="text" class="form-control" id="hours" name="hours" placeholder="Enter Minute">
            </div>
            <div class="col-6">
              <label for="date" class="form-label">Select Date</label>
              <input type="text" class="date-own form-control" id="date" name="date" placeholder="Select Date">
            </div>
          </div>
          <div class="mb-2">
              <label for="description" class="form-label">Enter Note</label>
              <textarea class="form-control" id="notes" name="notes" placeholder="Enter Description"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-form">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- END Main Container -->
@endsection

@section('admin-script')
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script>
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

  $(document).ready(function() {
    $('#payment-consumed-hours').DataTable({
      processing: true,
      serverSide: true,
      searchDelay: 600,
      ajax: {
        url: "{{route('admin.subscription.consumed-subscription-detail', ['id' => $subscription['id']])}}",
        method: 'GET',
      },
      columns: [
        { "data": "id", "visible": false, "searchable": false, "orderable": false },
        { "data": "consumed_type", "name": "consumed_type" },
        { "data": "hours", "name": "hours" },
        { "data": "date", "name": "date" },
        { "data": "notes", "name": "notes" },
        { "data": "action", "name": "action", "searchable": false, "orderable": false },
      ],
    });

    $('.date-own').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });

    $('select[name="consumed_type"]').on('change', function (e) {
      if(e.target.value == 'minute') {
        $('#hours').attr('placeholder', 'Enter Minutes');
        $('label[for="hours"]').text('Enter Minutes');
      } else {
        $('#hours').attr('placeholder', 'Enter Hours');
        $('label[for="hours"]').text('Enter Hours');
      }
    });

    $('#add-form').validate({
      rules: {
        consumed_type: {
          required: true,
        },
        hours: {
          required: true,
          number: true
        },
        date: {
          required: true,
          date: true
        },
      },
      messages: {
        consumed_type: {
          required: 'Please select consumed type',
        },
        hours: {
          required: 'Please enter hours',
          number: 'Please enter valid hours'
        },
        date: {
          required: 'Please select date',
          date: 'Please select valid date'
        },
      },
      errorElement: "em",
      errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("label"));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass, validClass) {
        if (errorClass) {
          $(element).closest('.form-control').addClass("is-invalid");
        } else {
          $(element).removeClass("is-valid");
        }
      },
      unhighlight: function(element, errorClass, validClass) {
        if (validClass) {
          $(element).closest('.form-control').removeClass("is-invalid");
        } else {
          $(element).removeClass("is-invalid");
        }
      }
    });

    $('#save-form').on('click', function (e) {
      e.preventDefault();

      if ($('#add-form').valid()) {
        $.ajax({
          url: "{{ route('admin.subscription.consumed-subscription', ['id' => $subscription['stripe_id']]) }}",
          method: "post",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: $('#add-form').serialize()
        }).done((response) => {
          if (response.success) {
            toastr.success(response.message);
            $('#total-pending-hours').html(response.data);
            if (response.data == 0) {
              $('button[data-bs-target="#add-consumed-details"]').remove();
              $('#status').text('consumed');
              // remove all class 
              $('#status').removeClass('bg-success-light text-success');
              $('#status').addClass('bg-warning-light text-warning');
            }
            $('#add-consumed-details').modal('hide');
            $('#payment-consumed-hours').DataTable().ajax.reload();
          } else {
            toastr.error(response.message);
          }
        })
      }
    })

    $('#add-consumed-details').on('hidden.bs.modal', function () {
      $('#add-form').trigger('reset');
    })
  });
</script>
@endsection
