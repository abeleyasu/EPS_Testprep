@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('page-style')
  <!-- Stylesheets -->
  <!-- Page JS Plugins CSS -->>
  <link rel="stylesheet" href="{{ asset('css/initial-college-list.css') }}">
@endsection

@section('user-content')
<style>
.block-content {
  padding: 1.25rem !important
}

.subscription-item {
  border-top: 1px solid #eee;
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
          <div class="block-header block-header-tab">
            <h3 class="block-title text-white">Active Subscription</h3>
          </div>
          <div class="block-content">
            @foreach($subscriptions as $subscription)
              <div class="card mb-2">
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <h3 class="block-title">Product</h3>
                    </div>
                    <div class="col-8">
                      {{ $subscription->plan->product->title }}
                    </div>
                  </div>
                  <div class="row subscription-item">
                    <div class="col-4">
                      <h3 class="block-title">Your Current Plan</h3>
                    </div>
                    <div class="col-8">
                      ${{ number_format($subscription->plan->amount) }} For {{ $subscription->plan->interval_count }} {{ $subscription->plan->interval }}
                    </div>
                  </div>
                  <div class="row subscription-item">
                    <div class="col-4">
                      <h3 class="block-title">Status</h3>
                    </div>
                    <div class="col-8">
                      @php 
                        $classname = 'bg-success-light text-success';
                        if ($subscription['stripe_status'] === 'failed') {
                          $classname = 'bg-danger-light text-danger';
                        } else if ($subscription['stripe_status'] === 'consumed' || $subscription['stripe_status'] === 'canceled') {
                          $classname = 'bg-warning-light text-warning';
                        }
                      @endphp
                      <span class="fs-sm fw-medium rounded text-center p-1 {{ $classname }}">{{ $subscription['stripe_status'] }}</span>
                    </div>
                  </div>
                  @if($subscription->plan_type == 'subscription')
                  <div class="row subscription-item">
                    <div class="col-4">
                      <h3 class="block-title">Billing Cycle</h3>
                    </div>
                    @if(!$subscription->is_auto_renewal)
                    <div class="col-8">
                      <div>
                        You will be charged ${{ number_format($subscription->plan->amount) }} on {{ $subscription->next_billing_date }}
                      </div>
                      <div>
                        <input type="checkbox" class="form-check-input" name="renewval" id="renewval" data-subscription_id="{{ $subscription->stripe_id }}" @if(!$subscription->is_auto_renewal) checked @endif>
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
                      <h3 class="block-title">Total Pending Hours:</h3>
                    </div>
                    <div class="col-8">
                      {{ $subscription->pending_consumed_hours }}
                    </div>
                  </div>
                  @endif
                  <div class="row subscription-item">
                    <div class="col-4">
                      <h3 class="block-title">Payment Information</h3>
                    </div>
                    <div class="col-8">
                      <div class="d-flex justify-content-between">
                        <span><span class="text-capitalize"><i class="fa-brands fa-cc-{{$subscription->card->card->brand}}"></i></span> ending with {{ $subscription->card->card->last4 }} ({{ $subscription->card->card->exp_month }}/{{ $subscription->card->card->exp_year }}) </span>
                        <!-- <span><a href="" class="text-uppercase">Change Method</a></span> -->
                      </div>
                    </div>
                  </div>
                  @if($subscription->plan_type == 'subscription')
                  <div class="row subscription-item text-center">
                    <div class="d-flex gap-2 justify-content-center">
                      @if(!auth()->user()->isUserSubscriptionOnGracePeriod() || $subscription->plan_type == 'one-time') 
                        <button class="btn btn-secondary px-4 cancel-subscription" data-id="{{ $subscription->stripe_id }}">Cancel {{ $subscription->plan_type == 'one-time' ? 'Plan' : 'Subscription' }}</button>
                      @else
                        <button class="btn btn-secondary px-4 resume-subscription">Resume Subscription</button>
                      @endif
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            @endforeach
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
    $('.cancel-subscription').click(function(e){
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
              subscription_id: $(this).data('id'),
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

    $('.resume-subscription').click(function(e){
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
            }
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

    $('.renewval').on('change', function (e) {
      e.preventDefault();
      $.ajax({
        url: "{{ route('mysubscriptions.renewal') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          subscription_id: $(this).data('subscription_id'),
          is_auto_renewal: e.target.checked
        },
      }).done(function (response) {
        if (response.success) {
          Swal.fire(
            'Success!',
            response.message,
            'success'
          ).then(function(result){
            if (result.isConfirmed) {
              location.reload();
              $(this).prop('checked', !$(this).prop('checked'));
            }
          })
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

