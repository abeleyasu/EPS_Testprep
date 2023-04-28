@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('user-content')
<main id="main-container">
  <div class="content">
    <div class="row justify-content-center">
      @if(count($plans) === 0)
      <div class="alert alert-warning">There is no plan available</div>
      @endif
      <div class="row">
        @foreach($plans as $plan)
          <div class="col-md-6 col-xl-3">
            <div class="block block-rounded block-link-shadow text-center">
              <div class="block-header">
                <h3 class="block-title">{{ $plan->name }}</h3>
              </div>
              <div class="block-content bg-body-light">
                <div class="py-2">
                  <p class="h1 fw-bold mb-2">${{ $plan->price }}</p>
                  <p class="h6 text-muted">Per <span class="text-capitalize">{{ $plan->plan_type }}</span></p>
                </div>
              </div>
              <div class="block-content">
                <div class="fs-sm py-2">
                  <p>{{ $plan->description }}</p>
                </div>
              </div>
              <div class="block-content block-content-full bg-body-light">
                <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-secondary px-4">Choose</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</main>
<script src="https://js.stripe.com/v3/"></script>

<script>
  const plans = '{{ $plans }}';
  if (plans.length > 0) {
    // const stripe = Stripe('{{ env('STRIPE_KEY') }}')
    // const elements = stripe.elements()
    // const cardElement = elements.create('card')
  
    // // cardElement.mount('#card-element')
  
    // const form = document.getElementById('payment-form')
    // const cardBtn = document.getElementById('card-button')
    // const cardHolderName = document.getElementById('card-holder-name')
  
    // cardBtn.addEventListener('click', async (e) => {
    //   console.log(cardElement);
    //   e.preventDefault()
  
    //   cardBtn.disabled = true
    //   const { setupIntent, error } = await stripe.confirmCardSetup(
    //     cardBtn.dataset.secret, {
    //       payment_method: {
    //         card: cardElement,
    //         billing_details: {
    //           name: 'Sanket'
    //         }
    //       }
    //     }
    //   )
  
    //   console.log('token:'+ setupIntent.payment_method);
  
    //   if(error) {
    //       cardBtn.disable = false
    //   } else {
    //     let token = document.createElement('input')
    //     token.setAttribute('type', 'hidden')
    //     token.setAttribute('name', 'token')
    //     token.setAttribute('value', setupIntent.payment_method)
    //     form.appendChild(token)
    //     form.submit();
    //   }
    // })
  }
</script>
@endsection
