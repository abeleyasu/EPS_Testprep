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
                                        value="{!! $user->state_id !!}">
                                    <option value="" disabled selected>--- Select State ---</option>
                                    @foreach($states as $st)
                                        <option value="{!! $st->id !!}"
                                                @if($user->state_id == $st->id) selected @endif>{!! $st->state_name !!}</option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 py-3">
                                <label for="name" class="form-label">City:</label>
                                <select name="city_id" id="city_id"
                                        class="form-control @if($errors->has('city_id')) is-invalid @endif"
                                        value="{!! $user->city_id !!}">
                                    <option value="" disabled selected>--- Select City ---</option>
                                    @foreach($cities as $ct)
                                        <option value="{!! $ct->id !!}"
                                                @if($user->city_id == $ct->id) selected @endif>{!! $ct->city_name !!}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 py-3">
                                <label for="name" class="form-label">Address line 1:</label>
                                <textarea name="address_line_1"
                                          class="form-control @if($errors->has('address_line_1')) is-invalid @endif"
                                          >{!! $user->address_line_1 !!}</textarea>
                                @error('address_line_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 py-3">
                                <label for="name" class="form-label">Address line 2:</label>
                                <textarea name="address_line_2"
                                          class="form-control @if($errors->has('address_line_2')) is-invalid @endif"
                                          >{!! $user->address_line_2 !!}</textarea>
                                @error('address_line_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 py-3">
                                <label for="name" class="form-label">Postal code:</label>
                                <input type="text" name="postal_code" value="{!! $user->postal_code !!}"
                                       class="form-control @if($errors->has('postal_code')) is-invalid @endif">
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">Saved Cards</h3>
                </div>
                <div class="block-content block-content-full space-y-3">
                    @foreach($cards['data'] as $key => $card)
                        <div class="form-check form-block">
                            <input type="radio" class="form-check-input" value="{{ $card->id }}" @if($customer && $customer->id === $card->id) checked @endif>
                            <label class="form-check-label">
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
                                    @else
                                    <a class="btn btn-sm btn-alt-primary" href="{{ route('user.setAsDefault', ['payment_id' => $card->id]) }}" >
                                        Set default
                                    </a>
                                    @endif
                                </div>
                                </div>
                            </span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
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

            const address = {
                line1: "{{ auth()->user()->address_line_1 }}",
                line2: "{{ auth()->user()->address_line_2 }}",
                city: "{{ auth()->user()->city() ? auth()->user()->city()->city_name : '' }}",
                state: "{{ auth()->user()->state() ? auth()->user()->state()->state_name : '' }}",
                postal_code: "{{ auth()->user()->postal_code }}",
            }

            const payment_method = {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value,
                        address: address,
                        email: "{{ auth()->user()->email }}",
                        phone: "{{ auth()->user()->phone }}"
                    }
                }
            }

            cardBtn.disabled = true
            const {setupIntent, error} = await stripe.confirmCardSetup(intent, payment_method)
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
