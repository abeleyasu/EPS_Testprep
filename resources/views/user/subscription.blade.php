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
            You will be charged ${{ number_format($plan->amount, 2) }} for {{ $plan->name }} Plan
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

              <div class="row mt-3">
                <div class="col">
                  <div class="form-group">
                    <label for="">Card details</label>
                    <div id="card-element" class="form-control"></div>
                  </div>
                </div>
              </div>

              <div id="card-errors" class="text-danger"></div>

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
            <form id="payment-form" action="{{ route('subscriptions.create-custome') }}" method="POST">
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

<script src="https://js.stripe.com/v3/"></script>
<script>
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
    const cardHolderName = document.getElementById('card-holder-name')

    form.addEventListener('submit', async (e) => {
      e.preventDefault()

      cardBtn.disabled = true
      const { setupIntent, error } = await stripe.confirmCardSetup(
        cardBtn.dataset.secret, {
          payment_method: {
            card: cardElement,
            billing_details: {
              name: cardHolderName.value
            }
          }
        }
      )
      if(error) {
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
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $('input[type="radio"]').on('change', function() {
  $('input[type="radio"]').not(this).prop('checked', false);
});
</script>
@endsection
