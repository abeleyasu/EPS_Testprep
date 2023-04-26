@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('user-content')
<style>
.plan-page{
    min-height: 95vh;
}
</style>
<div class="container plan-page">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Select Plane:</div>

                <div class="card-body">

                    <div class="row">
                        @foreach($plans as $plan)
                            <div class="col-md-6">
                                <div class="card mb-3">
                                  <div class="card-header">
                                        ${{ $plan->price }}/Mo
                                  </div>
                                  <div class="card-body">
                                    <h5 class="card-title">{{ $plan->name }}</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <div id="card-element"></div>

                                    <button id="card-button" data-secret="{{ $intent->client_secret }}">
                                        Update Payment Method
                                    </button>
                                    {{-- <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-primary pull-right">Choose</a> --}}

                                  </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}')

  const elements = stripe.elements()
  const cardElement = elements.create('card')

  cardElement.mount('#card-element')

  const form = document.getElementById('payment-form')
  const cardBtn = document.getElementById('card-button')
  const cardHolderName = document.getElementById('card-holder-name')

  cardBtn.addEventListener('click', async (e) => {
      console.log(cardElement);
      e.preventDefault()

      cardBtn.disabled = true
      const { setupIntent, error } = await stripe.confirmCardSetup(
          cardBtn.dataset.secret, {
              payment_method: {
                  card: cardElement,
                  billing_details: {
                      name: 'parth'
                  }
              }
          }
      )

      console.log('token:'+ setupIntent.payment_method);

      if(error) {
          cardBtn.disable = false
      } else {
          let token = document.createElement('input')
          token.setAttribute('type', 'hidden')
          token.setAttribute('name', 'token')
          token.setAttribute('value', setupIntent.payment_method)
          form.appendChild(token)
          form.submit();
      }
  })
</script>
@endsection
