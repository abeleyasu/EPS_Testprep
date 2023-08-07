@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('page-style')
  <!-- Stylesheets -->
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
@endsection

@section('user-content')
<style>
.block-content {
  padding: 1.25rem !important
}

.subscription-item {
  border-top: 1px solid #eee;
  /* border-bottom: 1px solid #eee; */
  padding: 15px 0px;
}
</style>
<main id="main-container">
  <div class="content">
    <div class="row justify-content-center">
      <div class="col-md-6">
        @if(session('message'))
        <div class="alert alert-success" role="alert">
          {{ session('message') }}
        </div>
        @endif
        <div class="block block-rounded block-link-shadow">
          <div class="block-header block-header-default">
            <h3 class="block-title">Subscription</h3>
          </div>
          <div class="block-content">
            <div class="row">
              <div class="col-4">
                <h3 class="block-title">Product</h3>
              </div>
              <div class="col-8">
                {{ $currentPlan->product->title }}
              </div>
            </div>
            <div class="row subscription-item">
              <div class="col-4">
                <h3 class="block-title">Your Current Plan</h3>
              </div>
              <div class="col-8">
                ${{ number_format($currentPlan->amount) }} For {{ $currentPlan->interval_count }} {{ $currentPlan->interval }}
              </div>
            </div>
            @if($subscription->plan_type == 'subscription')
            <div class="row subscription-item">
              <div class="col-4">
                <h3 class="block-title">Billing Cycle</h3>
              </div>
              @if(!$is_auto_renewal)
              <div class="col-8">
                <div>
                  You will be charged ${{ number_format($currentPlan->amount) }} on {{ $subscription->next_billing_date }}
                </div>
                <div>
                  <input type="checkbox" class="form-check-input" name="renewval" id="renewval" @if(!$is_auto_renewal) checked @endif>
                  Enable automatic renewal
                </div>
              </div>
              @else
              <div class="col-8">
                Your plan will expire in {{ $subscription->canceled_at }} <br>
              </div>
              @endif
            </div>
            @elseif($subscription->plan_type == 'one-time')
            <div class="row subscription-item">
              <div class="col-4">
                <h3 class="block-title">Billing Cycle</h3>
              </div>
              <div class="col-8">
                Your plan will expire in {{ $subscription->plan_end_date }}
              </div>
            </div>
            @endif
            <div class="row subscription-item">
              <div class="col-4">
                <h3 class="block-title">Payment Information</h3>
              </div>
              <div class="col-8">
                <div class="d-flex justify-content-between">
                  <span><span class="text-capitalize">{{ $card->card->brand }}</span> ending with {{ $card->card->last4 }} ({{ $card->card->exp_month }}/{{ $card->card->exp_year }}) </span>
                  <!-- <span><a href="" class="text-uppercase">Change Method</a></span> -->
                </div>
              </div>
            </div>
            <div class="row subscription-item text-center">
              <div class="d-flex gap-2 justify-content-center">
                @if(!auth()->user()->subscription('default')->onGracePeriod()) 
                  <button class="btn btn-secondary px-4" id="cancel-subscription">Cancel Subscription</button>
                @else
                  <button class="btn btn-secondary px-4" id="resume-subscription">Resume Subscription</button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection


@section('user-script')
<script src="{{asset('assets/js/sweetalert2/sweetalert2.all.min.js')}}"></script>
  <script>
    $('#cancel-subscription').click(function(e){
      console.log('cancel');
      e.preventDefault();
      Swal.fire({
        title: 'Are you sure to cancel this subscription?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, cancel it!',
        cancelButtonText: 'No, keep it'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "{{ route('mysubscriptions.cancel') }}",
            type: "POST",
            data: {
              _token: "{{ csrf_token() }}",
              subscription_id: "{{ $subscription->stripe_id }}"
            },
          }).done(function (response) {
            if (response.success) {
              if (response.type == 'one-time') {
                Swal.fire(
                  'Cancelled!',
                  'Your subscription has been cancelled.',
                  'success'
                ).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = "{{ route('plan.index') }}";
                  }
                })
              } else {
                Swal.fire('Cancelled!', 'Your subscription has been cancelled.', 'success').then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                })
              }
            } else {
              Swal.fire('Error!', response.message,'error')
            }
          })
        }
      })
    })

    $('#resume-subscription').click(function(e){
      console.log('resume');
      e.preventDefault();
      Swal.fire({
        title: 'Are you sure to resume this subscription?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, resume it!',
        cancelButtonText: 'No, keep it'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "{{ route('mysubscriptions.resume') }}",
            type: "POST",
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
          }).done(function (response) {
            if (response.success) {
              Swal.fire(
                'Resumed!',
                'Your subscription has been resumed.',
                'success'
              ).then((result) => {
                if (result.isConfirmed) {
                  location.reload();
                }
              })
            } else {
              Swal.fire('Error!', response.message,'error')
            }
          })
        }
      })
    })

    $('#renewval').on('change', function (e) {
      e.preventDefault();
      $.ajax({
        url: "{{ route('mysubscriptions.renewal') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          subscription_id: "{{ $subscription->stripe_id }}",
          is_auto_renewal: e.target.checked
        },
      }).done(function (response) {
        if (response.success) {
          Swal.fire(
            'Success!',
            response.message,
            'success'
          )
          $(this).prop('checked', !$(this).prop('checked'));
        } else {
          Swal.fire(
            'Error!',
            response.message,
            'error'
          )
        }
      })
    })
  </script>
@endsection

