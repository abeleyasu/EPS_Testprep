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
  .category-title-holder {
      /* border: 1px solid lightgray; */
      border-radius: 30px;
      cursor: pointer;
      margin-bottom: 15px;
      padding: 0 2px;
      background-color: #ffffff;
  }
  .category-title {
      width: 100%;
      text-align: center;
      padding: 15px 0;
      margin: 2px 0;
  }
  .category-title.active {
      /*background: #232e3e;
      background: #1f2937;*/

      background: rgb(15,32,39);
      background: linear-gradient(90deg, rgba(15,32,39,1) 0%, rgba(32,58,67,1) 50%, rgba(44,83,100,1) 100%);
      border-radius: 30px;
      color: #ffffff;

  }
  .category-title:not(.active):hover {
      color: #232e3e;
  }
  .custom-tab {
      max-width: 900px;
  }


</style>


<main id="main-container">
  <div class="content">
    <div class="row justify-content-center">
      @if(count($categories) === 0 )
      <div class="alert alert-warning">There is no plan available</div>
      @else
            <div class="row">
                <div class="col-md-12">
                    <h1 class="line-title text-center position-relative">
                        Pricing
                    </h1>
                </div>

            </div>
          <div class="d-flex category-title-holder custom-tab">
          @foreach($categories as $idx => $category)
              <div class="category-title inactive-all @if($idx == 0) active @endIf" id="cate-title-{!! $category->id !!}" onclick="showByCategoryId({!! $category->id !!})">{!! $category->title !!}</div>
          @endforeach
          </div>

            <div class="pricing-content text-center mb-4">
                <h1 class="mb-1">
                    College Prep System Features & Pricing
                </h1>
                <p class="mb-1">
                    Get limited access to our free modules and tools
                </p>
                <p class="mb-1">
                    Get FULL ACCESS to our powerful modules and tools
                </p>
            </div>


          @foreach($categories as $idx2 => $category)
              <div class="hide-all hide-all" @if($idx2 != 0) style="display: none" @endIf id="cate-{!! $category->id !!}">
                  <div class="row d-flex justify-content-center">
                    @foreach($category->products as $product)
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
                                    @else
                                      <span class="text-muted interval"><span class="text-capitalize">/year</span></span>
                                    @endif
                                  </p>
                                  @if($plan->interval === 'month')
                                    <p class="text-muted"><span class="text-capitalize">{{ $plan->interval_count }} Month Plan</span></p>
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
          @endforeach
      @endif
    </div>
  </div>
</main>
<script src="https://js.stripe.com/v3/"></script>

<script>
        function showByCategoryId(id) {
            $(`.hide-all`).hide();
            $(`#cate-${id}`).show();
            $(`.inactive-all`).removeClass('active');
            $(`#cate-title-${id}`).addClass('active');
        }
  {{--const plans = '{{ $products }}';--}}
  {{--if (plans.length > 0) {--}}
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
  // }
</script>
@endsection
