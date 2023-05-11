@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('user-content')
<style>
  .inclusion-check-icon {
    font-size: 15px;
    color: #B2CB20;
    font-weight: 900;
  }
  .inclusion {
    font-size: 15px;
  }
  .product-list {
    padding: 35px 5px;
  }
  .product-title {
    color: #384141;
    font-size: 1.5rem;
    font-weight: 300;
    line-height: 1.2;
    margin-bottom: 0px;
    letter-spacing: 0px;
    margin: 0px;
    min-height: auto;
    text-transform: none;
  }
  .product-description {
    font-size: 14px;
    letter-spacing: 0px;
    margin: 0px;
    min-height: auto;
    text-transform: none;
    font-weight: normal;
    line-height: 1.7;
    margin-bottom: 30px !important;
    padding: 0px 10px;
    color: #808080
  }
  .pricing-price {
    padding: 15px 0 14px 0;
    border-top: 1px solid rgba(139, 144, 157, 0.18);
    border-bottom: 1px solid rgba(139, 144, 157, 0.18)
  }
  .pricing-description p {
    margin: 0px;
    color: #384141
  }
  .pricing-description .currency {
    font-weight: 300;
    font-size: 2rem;
  }
  .interval {
    font-size: 12px;
    letter-spacing: 0.5px;
  }
</style>


<main id="main-container">
  <div class="content">
    <div class="row justify-content-center">
      @if(count($products) === 0 )
      <div class="alert alert-warning">There is no plan available</div>
      @endif
      <div class="row d-flex justify-content-center">
        @foreach($products as $product)
          @if (count($product->plans) > 0)
            <div class="col-md-6 col-xl-3">
              <div class="block block-rounded block-link-shadow text-center product-list">
                <div class="block-header">
                  <h3 class="block-title product-title">{{ $product->title }}</h3>
                </div>
                <p class="product-description">{{ $product->description }}</p>
                @foreach($product->plans as $plan)
                  <div class="block-content pricing-price">
                    <div class="py-2 pricing-description">
                      <p class="currency">${{ $plan->display_amount }}
                        @if($plan->interval === 'month')
                          <span class="text-muted interval">/Per <span class="text-capitalize">{{ $plan->interval }}</span></span>
                        @endif
                      </p>
                      @if($plan->interval === 'month')
                        <p class="text-muted"><span class="text-capitalize">{{ $plan->interval_count }} Month Plan</span></p>
                      @else
                        <p class="text-muted"><span class="text-capitalize">/year</span></p>
                      @endif
                    </div>
                    <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-secondary px-4">Choose</a>
                  </div>
                @endforeach

                <div class="block-content">
                  <div class="fs-sm py-2">
                      @foreach($product->inclusions as $inc)
                          <p class="text-start d-flex align-items-center inclusion"><i class="fa fa-fw fa-check me-1 inclusion-check-icon"></i> {!! $inc->inclusion !!}</p>
                      @endforeach
                  </div>
                </div>
              </div>
            </div>
          @endif
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
