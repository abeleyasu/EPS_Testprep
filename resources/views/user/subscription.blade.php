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
