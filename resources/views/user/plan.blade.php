@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('user-content')
<main id="main-container">
  <div class="content">
    <div class="row justify-content-center">
      @if(count($products) === 0)
      <div class="alert alert-warning">There is no plan available</div>
      @endif
      <div class="row">
        @foreach($products as $product)
          <div class="col-md-6 col-xl-3">
            <div class="block block-rounded block-link-shadow text-center">
              <div class="block-header">
                <h3 class="block-title">{{ $product->title }}</h3>
              </div>
              <div class="block-header">
                <h6>{{ $product->description }}</h6>
              </div>
              @foreach($product->plans as $plan)
                <div class="block-content bg-body-light">
                  <div class="py-2">
                    <p class="h1 fw-bold mb-2">${{ $plan->display_amount }}
                      @if($plan->interval === 'month')
                        <p class="text-muted">/Per <span class="text-capitalize">{{ $plan->interval }}</span></p>
                      @endif
                    </p>
                    @if($plan->interval === 'month')
                      <p class="h6 text-muted"><span class="text-capitalize">{{ $plan->interval_count }} Month Plan</span></p>
                    @else
                      <p class="h6 text-muted"><span class="text-capitalize">/year</span></p>
                    @endif
                  </div>
                </div>
                    <div class="block-content block-content-full bg-body-light">
                        <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-secondary px-4">Choose</a>
                    </div>
              @endforeach

              <div class="block-content">
                <div class="fs-sm py-2">
                    @foreach($product->inclusions as $inc)
                        <p class="text-start"><i class="fa fa-fw fa-check me-1"></i> {!! $inc->inclusion !!}</p>
                    @endforeach
                </div>
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
  const plans = '{{ $products }}';
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
