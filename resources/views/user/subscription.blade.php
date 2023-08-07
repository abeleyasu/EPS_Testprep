@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('user-content')
<style>
.view-card{
  display: flex;
  flex-wrap: wrap;
}
.block-content {
  padding: 1.25rem !important
}
.StripeElement {
  box-sizing: border-box;
  height: 40px;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: white;
  width: 100%;
  margin-top: 10px;
}
.StripeElement--empty {
  background-color: white;
}
.StripeElement--invalid {
  border-color: #fa755a;
}
.StripeElement--focus {
  border-color: #1e1e1e;
}
</style>
<main id="main-container">
  <div class="content">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="block block-rounded block-link-shadow">
          <div class="block-header">
            You will be charged ${{ $plan->amount }} for {{ $plan->name }} Plan
          </div>
          <div class="block-content">
            <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
              @csrf
              <input type="hidden" name="plan" id="plan" value="{{ $plan->stripe_plan_id }}">
              <input type="hidden" name="intent_id" value="{{ $intent->id }}">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
                  </div>
                </div>
              </div>

              <div class="row mt-3 mb-2">
                <div class="col">
                  <div class="form-group">
                    <label for="">Card details</label>
                    <div id="card-element" class="form-control"></div>
                  </div>
                </div>
              </div>

              <div id="card-errors" class="text-danger"></div>

              <div class="mb-2">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="default_billing_details" name="default_billing_details">
                  <label class="form-check-label" for="default_billing_details">Used Default Billing Details</label>
                </div>
              </div>

              <div class="billing-form">
                <div class="mb-2 mt-2 row">
                  <div class="col-6">
                    <label for="state" class="form-label">State:</label>
                    <select name="state" id="state" class="form-control">
                    </select>
                  </div>
  
                  <div class="col-6">
                    <label for="city" class="form-label">City:</label>
                    <select name="city" id="city" class="form-control">
                    </select>
                  </div>
  
                  <div class="col-md-12 py-2">
                    <label for="address_line_1" class="form-label">Address line 1:</label>
                    <input type="text" class="form-control" placeholder="Address line 1" name="address_line_1" id="address_line_1">
                  </div>
                  <div class="col-md-12 py-2">
                    <label for="address_line_2" class="form-label">Address line 2:</label>
                    <input type="text" class="form-control" placeholder="Address line 2" name="address_line_2" id="address_line_2">
                  </div>
                  <div class="col-md-12 py-2">
                    <label for="zip_code" class="form-label">Postal Code:</label>
                    <input type="text" class="form-control" placeholder="Postal Code" name="zip_code" id="zip_code">
                  </div>
                </div>
              </div>


              <div class="row mt-3">
                <div class="col">
                  <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Subscribe Now</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        @if(count($cards['data']) > 0)
        <div class="block block-rounded">
          <div class="block-header">
            <h3 class="block-title">
              Saved Cards
            </h3>
          </div>
          <div class="block-content block-content-full space-y-3">
            <form id="user-card-form" action="{{ route('subscriptions.create-custome') }}" method="POST">
              @csrf
              <input type="hidden" name="plan" id="plan" value="{{ $plan->stripe_plan_id }}">
              @foreach($cards['data'] as $key => $card)
              <div class="form-check form-block">
                <input type="radio" class="form-check-input" id="checkout-delivery-{{$key + 1}}" name="user_card" value="{{ $card->id }}" @if($customer && $customer->id === $card->id) checked @endif>
                <label class="form-check-label" for="checkout-delivery-{{$key + 1}}">
                  <span class="d-block fw-normal p-1">
                    <div class="row">
                      <div class="col-5">
                        <span class="fw-semibold mb-1">{{ $card->billing_details->name }} ({{ $card->card->exp_month }}/{{ $card->card->exp_year }})</span>
                      </div>
                      <div class="col-5">
                        <span class="fw-semibold mb-1">{{ $card->card->brand }} ({{ $card->card->last4 }})</span>
                      </div>
                      <div class="col-2">
                        @if($customer && $customer->id === $card->id)
                          <div class="btn btn-sm btn-alt-success">
                            default
                          </div>
                        @endif
                      </div>
                    </div>
                  </span>
                </label>
              </div>
              @endforeach
              <div class="row mt-3">
                <div class="col">
                  <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" data-secret="{{ $intent->client_secret }}">Subscribe With Existing Card</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        @else
        <div class="alert alert-warning">
          <p class="mb-0">No card found. Please <a href="{{ route('user.get-billing-detail') }}" class="fw-semibold">Add Card</a> to subscribe. 
          </p>
        </div>
        @endif
      </div>
    </div>
  </div>
</main>
@endsection

@section('user-script')
<script src="{{asset('assets/js/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/subscription.js') }}"></script>
<script>

  $(document).ready(function () {

    function initStateAndCityDropdown() {
      $('select[name="state"]').select2({
        placeholder: '--- Select State ---',
        ajax: ajax("{{ route('get-states') }}", {
          is_for_subscription: true,
        })
      });
  
      $('select[name="city"]').select2({
        placeholder: '--- Select City ---',
      })
  
      $('select[name="state"]').on('change', function() {
        $('select[name="city"]').val(null).trigger('change')
        const url = "{{ route('get-cities', ['id' => ':id']) }}".replace(':id', $(this).val())
        $.ajax({
          url: url,
          type: 'GET',
          data: {
            is_for_subscription: true,
          }
        }).done((response) => {
          $('select[name="city"]').html('')
          response.forEach((city) => {
            $('select[name="city"]').append(`<option value="${city.id}">${city.text}</option>`)
          })
        })
      })
    }

    initStateAndCityDropdown()
    

    $('input[name="default_billing_details"]').on('change', function (e) {
      if (e.target.checked) {
        $('.billing-form').html('')
      } else {
        $('.billing-form').html(
          `
            <div class="mb-2 mt-2 row">
              <div class="col-6">
                <label for="state" class="form-label">State:</label>
                <select name="state" id="state" class="form-control">
                </select>
              </div>

              <div class="col-6">
                <label for="city" class="form-label">City:</label>
                <select name="city" id="city" class="form-control">
                </select>
              </div>

              <div class="col-md-12 py-2">
                <label for="address_line_1" class="form-label">Address line 1:</label>
                <input type="text" class="form-control" placeholder="Address line 1" name="address_line_1" id="address_line_1">
              </div>
              <div class="col-md-12 py-2">
                <label for="address_line_2" class="form-label">Address line 2:</label>
                <input type="text" class="form-control" placeholder="Address line 2" name="address_line_2" id="address_line_2">
              </div>
              <div class="col-md-12 py-2">
                <label for="zip_code" class="form-label">Postal Code:</label>
                <input type="text" class="form-control" placeholder="Postal Code" name="zip_code" id="zip_code">
              </div>
            </div>
          `
        )
        initStateAndCityDropdown()
      }
    })

  })
  


    const stripe = Stripe('{{ env('STRIPE_KEY') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card')

    cardElement.mount('#card-element')
    const cardBtn = document.getElementById('card-button')
    cardElement.on('change', (e) => {
      if(e.error) {
        cardBtn.disabled = true
        $('#card-errors').text(e.error.message)
      } else {
        cardBtn.disabled = false
        $('#card-errors').text('')
      }
    })

    const form = document.getElementById('payment-form')

    form.addEventListener('submit', async (e) => {
      e.preventDefault()

      const isDefaultBillingDetails = document.getElementById('default_billing_details')
      const cardHolderName = document.getElementById('card-holder-name')

      if (!isDefaultBillingDetails.checked && !$('#payment-form').valid()) {
        return false;
      }

      const address = {
        line1: $('input[name="address_line_1"]').val(),
        line2: $('input[name="address_line_2"]').val(),
        city: $('select[name="city"] option:selected').text(),
        state: $('select[name="state"] option:selected').text(),
        postal_code: $('input[name="zip_code"]').val(),
      }

      if (isDefaultBillingDetails.checked) {
        address.line1 = "{{ auth()->user()->address_line_1 }}",
        address.line2 = "{{ auth()->user()->address_line_2 }}",
        address.city = "{{ auth()->user()->city() ? auth()->user()->city()->city_name : '' }}",
        address.state = "{{ auth()->user()->state() ? auth()->user()->state()->state_name : '' }}",
        address.postal_code = "{{ auth()->user()->postal_code }}"
      }

      const payment_method = {
        payment_method: {
          card: cardElement,
          billing_details: {
            name: cardHolderName.value,
            address: address,
            email: "{{ auth()->user()->email }}",
            phone: "{{ auth()->user()->phone }}"
          }
        }
      }

      cardBtn.disabled = true
      const { setupIntent, error } = await stripe.confirmCardSetup(cardBtn.dataset.secret, payment_method)
      if(error) {
        console.log(error)
        cardBtn.disable = false
      } else {
        let token = document.createElement('input')
        token.setAttribute('type', 'hidden')
        token.setAttribute('name', 'payment_method')
        token.setAttribute('value', setupIntent.payment_method)
        form.appendChild(token)
        form.submit();
      }
    })


    const userExistingcardForm = document.getElementById('user-card-form')

    userExistingcardForm.addEventListener('submit', function(e) {
      e.preventDefault()
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to subscribe with this card!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, subscribe it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          userExistingcardForm.submit()
        }
      })
    })
</script>
@endsection
