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
                          @elseif($plan->interval === 'year')
                            <span class="text-muted interval"><span class="text-capitalize">/year</span></span>
                          @endif
                        </p>
                        @if($plan->interval === 'month')
                          <p class="text-muted"><span class="text-capitalize">{{ $plan->interval_count }} Month Plan</span></p>
                        @elseif($plan->interval === 'hour')
                          <p class="text-muted"><span class="text-capitalize">{{ $plan->interval_count }} Hour Plan</span></p>
                        @endif
                      </div>
                      @if(auth()->user())
                        @if(Auth::user()->subscribed('default'))
                          @if(Auth::user()->subscriptions()->active()->first()->stripe_price == $plan->stripe_plan_id)
                            <div class="btn btn-light px-4">Purchased</div>
                          @else
                            <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-secondary px-4">Upgrade</a>
                          @endif
                        @else 
                          <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-secondary px-4">Choose</a>
                        @endif
                      @else
                        <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-secondary px-4">Choose</a>
                      @endif
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