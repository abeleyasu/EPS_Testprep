@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('user-content')
<style>
.view-card{
  display: flex;
  flex-wrap: wrap;
}
</style>
<main id="main-container">
  <div class="content">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            You will be charged ${{ number_format($plan->amount, 2) }} for {{ $plan->name }} Plan
          </div>
          <div class="card-body">
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

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="">Card details</label>
                    <div id="card-element" class="form-control"></div>
                  </div>
                </div>
              </div>

              <div class="col-xl-12 col-lg-12">
                <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Purchase</button>
              </div>
            </form>
          </div>
        </div>
          @foreach($cards['data'] as $card)
              <div class="block-bordered block-rounded block overflow-hidden mb-1">
                  <div class="block-header block-header-default" id="app-card">
                    <input type="radio" name="" id="paycard" value="{{$card->id}}">
                      <div>
                          <span>{{ $card->card->brand }}</span>
                          <span>{{ $card->billing_details->name }}</span>
                      </div>
                      <span class="text-uppercase">{{ $card->card->brand }}({{$card->card->last4}})</span>
                      <span>{{ $card->card->exp_month }}/{{$card->card->exp_year}}</span>
                  </div>
              </div>
          @endforeach
          <!-- <div>
            <input type="hidden" name="" id="card_value" value="">
              <button id="pay_card" type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Pay">
                  <i class="fa fa-fw fa-times"></i>Pay
              </button>
          </div> -->
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

    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
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

  // $(document).ready(function(){
  //         $('input[type="radio"]').click(function() {
  //           var selectedOption = $(this).val();
  //           $("#card_value").val(selectedOption);
  //           // console.log(selectedOption);
  //         });

  //         $("#pay_card").click(function(){
  //           var cardName = $("#card_value").val();
  //           var planid = $('#plan').val();
  //           // if($(this).is(':checked')){
  //             $.ajax({
  //                   'url': "{{route('subscription.paycard')}}",
  //                   'type': "POST",
  //                   'data': {cardName, planid},
  //                   'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  //                   success:function(response){
  //                     console.log(response)
  //                   }
  //               })
  //           // }
  //         });
  //       });
</script>
@endsection
