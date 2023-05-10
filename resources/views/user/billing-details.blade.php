@extends('layouts.user')

@section('title', 'User Dashboard : CPS')

@section('user-content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content mb-4">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Billing Detail</h3>
                </div>
                <div class="block-content block-content-full">
                    <form action="{!! route('user.save-billing-detail') !!}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 py-3">
                                <label for="name" class="form-label">State:</label>
                                <select name="state_id" id="billing_state"
                                        class="form-control @if($errors->has('state_id')) is-invalid @endif"
                                        required value="{!! $user->state_id !!}">
                                    <option value="" disabled selected>--- Select State ---</option>
                                    @foreach($states as $st)
                                        <option value="{!! $st->id !!}"
                                                @if($user->state_id == $st->id) selected @endif>{!! $st->state_name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 py-3">
                                <label for="name" class="form-label">City:</label>
                                <select name="city_id" id="city_id"
                                        class="form-control @if($errors->has('city_id')) is-invalid @endif" required
                                        value="{!! $user->city_id !!}">
                                    <option value="" disabled selected>--- Select City ---</option>
                                    @foreach($cities as $ct)
                                        <option value="{!! $ct->id !!}"
                                                @if($user->city_id == $ct->id) selected @endif>{!! $ct->city_name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 py-3">
                                <label for="name" class="form-label">Address line 1:</label>
                                <textarea name="address_line_1"
                                          class="form-control @if($errors->has('address_line_1')) is-invalid @endif"
                                          required>{!! $user->address_line_1 !!}</textarea>
                            </div>
                            <div class="col-md-12 py-3">
                                <label for="name" class="form-label">Address line 2:</label>
                                <textarea name="address_line_2"
                                          class="form-control @if($errors->has('address_line_2')) is-invalid @endif"
                                          required>{!! $user->address_line_2 !!}</textarea>
                            </div>
                            <div class="col-md-6 py-3">
                                <label for="name" class="form-label">Postal code:</label>
                                <input type="text" name="postal_code" value="{!! $user->postal_code !!}"
                                       class="form-control @if($errors->has('address_line_2')) is-invalid @endif"
                                       required>
                            </div>
                        </div>
                        <div class="row mb-4 mt-4">
                            <div class="col-md-6 col-xl-5">
                                <button id="button" type="submit" class="btn w-100 btn-alt-success">
                                    <i class="fa fa-fw fa-pencil me-1 opacity-50"></i> Save Billing Detail
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Card Detail</h3>
                </div>
                <div class="block-content block-content-full">
                    <form id="payment-form" action="{{ route('user.billing-detail') }}" method="POST">
                        @csrf
                        <div class="py-3">
                            <div class="mb-4">
                                <label for="card_number" class="form-label">Card Holder Name</label>
                                <input type="text"
                                       class="form-control form-control-lg form-control-alt {{ $errors->has('card_holder_name') ? 'is-invalid' : '' }}"
                                       id="card_holder_name" name="card_holder_name" placeholder="Card Holder Name"
                                       value="{{ isset($user->billing_details) ? $user->billing_details->card_holder_name : null }}">
                                @error('card_holder_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div id="card-element" name="token" class="form-control"></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 col-xl-5">
                                <button id="button" type="submit" class="btn w-100 btn-alt-success"
                                        data-secretkey="{{ $intent }}">
                                    <i class="fa fa-fw fa-pencil me-1 opacity-50"></i> Add Payment Details
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- END Edit User Form -->
                </div>
            </div>
            @foreach($cards['data'] as $card)
                <div class="block-bordered block-rounded block overflow-hidden mb-1">
                    <div class="block-header block-header-default">
                        <div>
                            <span>{{ $card->card->brand }}</span>
                            <span>{{ $card->billing_details->name }}</span>
                        </div>
                        <span class="text-uppercase">{{ $card->card->brand }}({{$card->card->last4}})</span>
                        <span>{{ $card->card->exp_month }}/{{$card->card->exp_year}}</span>
                        <div>
                            <button type="button" class="btn btn-sm btn-alt-secondary delete-card"
                                    data-id="{{$card->id}}"
                                    data-bs-toggle="tooltip" title="Delete Card">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
    <!-- END Main Container -->
@endsection

@section('user-script')

    <script>
        $(document).ready(function () {
            $('#billing_state').on('change', function () {
                getCity(this.value);
            })
        });

        function getCity(state_id) {
            const city_id = {!! $user->city_id ?: 'null' !!};
            if (state_id) {
                $('#city_id').val('');
                $('#city_id').attr('disabled');
                $.ajax({
                    url: 'get-cities/' + state_id,
                    method: 'get',
                    success: function (data) {
                        $('#city_id').empty()
                        let city_options = '<option value="" disabled selected>--- Select City ---</option>'
                        data.forEach(element => {

                            city_options += `<option ${city_id == element.id ? 'selected' : null} value="${element.id}">${element.city_name}</option>`
                        });
                        $('#city_id').html(city_options)
                        $('#city_id').removeAttr('disabled')
                    }
                })
            }
        }
    </script>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}')

        const elements = stripe.elements()
        const cardElement = elements.create('card')

        cardElement.mount('#card-element')

        cardElement.on('change', function (event) {
            document.getElementById("button").disabled = event.empty;
        })
        const form = document.getElementById('payment-form')
        const cardBtn = document.getElementById('button')
        const cardHolderName = document.getElementById('card_holder_name')


        const intent = "{{ $intent }}";

        form.addEventListener('submit', async (e) => {
            e.preventDefault()
            cardBtn.disabled = true
            const {setupIntent, error} = await stripe.confirmCardSetup(
                intent, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            )
            if (error) {
                cardBtn.disable = false
            } else {
                let token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'stripeToken')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit();
            }
        })
    </script>
    <script>
        $('.delete-card').click(function () {
            if (confirm("Are you sure to delete this card?") == true) {
                $.ajax({
                    'url': "{{route('user.delete.card')}}",
                    'type': "POST",
                    'data': {id: $(this).data('id')},
                    'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                }).done(function (data) {
                    document.location.reload();
                });
            }
        });
    </script>
@endsection
