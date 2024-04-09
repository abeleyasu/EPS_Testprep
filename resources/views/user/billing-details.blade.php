@extends('layouts.user')

@section('title', 'User Dashboard : CPS')

@section('user-content')
<link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
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
                            <div id="card-errors" class="text-danger"></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 col-xl-5">
                                <button id="button" type="submit" class="btn w-100 btn-alt-success"
                                        data-secretkey="{{ $intent }}">
                                    <i class="fa fa-fw fa-pencil me-1 opacity-50"></i> Save Payment Details
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
                                    <span class="fw-semibold mb-1"><i class="fa-brands fa-cc-{{$card->card->brand}}"></i>{{ $card->card->brand }} ({{ $card->card->last4 }})</span>
                                </div>
                                <div class="col-2 d-flex gap-1">
                                    @if($customer && $customer->id === $card->id)
                                    <div class="btn btn-sm btn-alt-success">
                                        default
                                    </div>
                                    @else
                                    <a class="btn btn-sm btn-alt-primary" href="{{ route('user.setAsDefault', ['payment_id' => $card->id]) }}" >
                                        Set default
                                    </a>
                                    @endif
                                    <div>
                                        <button class="btn btn-sm btn-alt-danger delete-card" data-id="{{ $card->id }}" data-bs-toggle="tooltip" title="Delete Card">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
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
<script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>

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
                $('#card-errors').text(error.message)
                console.log('error', error)
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
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this card?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        'url': "{{route('user.delete.card')}}",
                        'type': "POST",
                        'data': {id: $(this).data('id')},
                        'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    }).done(function (response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then((result) => {
                                location.reload();
                            })
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            )
                        }
                    });
                }
            })
        });
    </script>
@endsection
