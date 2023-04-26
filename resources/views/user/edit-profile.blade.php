@extends('layouts.user')

@section('title', 'User Dashboard : CPS')

@section('user-content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <!-- Dynamic Table Full -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit User</h3>
                </div>
                <div class="block-content block-content-full">
                    <form action="{{ route('user.edit-profile') }}" method="POST">
                        @csrf
                        <div class="py-3">
                            <div class="mb-4">
                                <input type="text"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                    id="first_name" name="first_name" placeholder="First Name"
                                    value="{{ $user->first_name }}">
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="text"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                    id="last_name" name="last_name" placeholder="Last Name" value="{{ $user->last_name }}">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="email"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    id="email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="mb-4">
                                <input type="text"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                    id="phone" name="phone" placeholder="Phone" value="{{ $user->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="password"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    id="password" name="password" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="text" name="id" value="{{ $user->id }}" hidden>
                        <div class="row mb-4">
                            <div class="col-md-6 col-xl-5">
                                <button type="submit" class="btn w-100 btn-alt-success">
                                    <i class="fa fa-fw fa-pencil me-1 opacity-50"></i> Update User
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- END Edit User Form -->
                </div>
            </div>
            {{-- {{dd($user->billing_details)}} --}}

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Billing Detail</h3>
                </div>
                <div class="block-content block-content-full">
                    <form action="{{ route('user.billing-detail') }}" method="POST">
                        @csrf
                        <div class="py-3">
                            <div class="mb-4">
                                <label for="billing_address" class="form-label">Billing Address</label>
                                <input type="text"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('billing_address') ? 'is-invalid' : '' }}"
                                    id="billing_address" name="billing_address" placeholder="Billing Address"
                                    value="{{ isset($user->billing_details) ? $user->billing_details->billing_address : null }}">
                                @error('billing_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="billing_state" class="form-label">State</label>
                                    <select class="form-select {{ $errors->has('billing_state') ? 'is-invalid' : '' }}"
                                        id="billing_state" name="billing_state" placeholder="Billing State"
                                        value="{{ isset($user->billing_details) ? $user->billing_details->billing_state : null }}"
                                        aria-label="billing_state">
                                        <option selected disabled>Selecet State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ isset($user->billing_details) && $user->billing_details->billing_state == $state->id ? 'selected' : '' }}>
                                                {{ $state->state_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('billing_state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="billing_city" class="form-label">City</label>
                                    <input type="hidden" name="city_id" id="city_id" value="{{ isset($user->billing_details) ? $user->billing_details->billing_city : null }}">
                                    <select class="form-select {{ $errors->has('billing_city') ? 'is-invalid' : '' }}"
                                        id="billing_city" name="billing_city" placeholder="Billing City"
                                        value="{{ isset($user->billing_details) ? $user->billing_details->billing_city : null }}"
                                        aria-label="billing_city">
                                        <option selected disabled>Selecet City</option>
                                    </select>
                                    @error('billing_city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="billing_zip" class="form-label">ZipCode</label>
                                    <input type="text"
                                        class="form-control form-control-lg form-control-alt {{ $errors->has('billing_zip') ? 'is-invalid' : '' }}"
                                        id="billing_zip" name="billing_zip" placeholder="Billing Address"
                                        value="{{ isset($user->billing_details) ? $user->billing_details->billing_zip : null }}">
                                    @error('billing_zip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input type="text"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('card_number') ? 'is-invalid' : '' }}"
                                    id="card_number" name="card_number" placeholder="Card Number"
                                    value="{{ isset($user->billing_details) ? decrypt($user->billing_details->card_number) : null }}">
                                @error('card_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="card_expiry_month" class="form-label">Card Expiry Month</label>
                                    <select
                                        class="form-select {{ $errors->has('card_expiry_month') ? 'is-invalid' : '' }}"
                                        id="card_expiry_month" name="card_expiry_month" placeholder="Billing State"
                                        value="{{ isset($user->billing_details) ? $user->billing_details->card_expiry_month : null }}"
                                        aria-label="card_expiry_month">
                                        <option selected disabled>Selecet month</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option {{isset($user->billing_details) && $user->billing_details->card_expiry_month == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('card_expiry_month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="card_expiry_year" class="form-label">Card Expiry Year</label>
                                    <select class="form-select {{ $errors->has('card_expiry_year') ? 'is-invalid' : '' }}"
                                        id="card_expiry_year" name="card_expiry_year" placeholder="Billing State"
                                        value="{{ isset($user->billing_details) ? $user->billing_details->card_expiry_year : null }}"
                                        aria-label="card_expiry_year">
                                        <option selected disabled>Selecet Year</option>
                                        @for ($i = 0; $i <= 10; $i++)
                                            {{ $nextYear = date('Y') + $i }}
                                            <option {{ isset($user->billing_details) && $user->billing_details->card_expiry_year == $nextYear ? 'selected' : '' }} value="{{ $nextYear }}">{{ $nextYear }}</option>
                                        @endfor
                                    </select>
                                    @error('card_expiry_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="text" name="id" value="{{ $user->id }}" hidden>
                        <div class="row mb-4">
                            <div class="col-md-6 col-xl-5">
                                <button type="submit" class="btn w-100 btn-alt-success">
                                    <i class="fa fa-fw fa-pencil me-1 opacity-50"></i> Update Details
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- END Edit User Form -->
                </div>
            </div>
        </div>
    </main>
    <!-- END Main Container -->
@endsection

@section('user-script')

    <script>
        $(document).ready(function() {
            console.log($('#billing_state').val());
            getCity($('#billing_state').val());
                $('#billing_state').on('change', function() {
                    getCity(this.value);
                })
        });

        function getCity(state_id) {
            const city_id = $('#city_id').val()
            console.log(city_id);
            $.ajax({
                url: 'get-cities/' + state_id,
                method: 'get',
                success: function(data) {
                    $('#billing_city').empty()
                    let city_options = ''
                    data.forEach(element => {

                        city_options += `<option ${city_id == element.id ? 'selected' : null} value="${element.id}">${element.city_name}</option>`
                    });
                    console.log(city_options);
                    $('#billing_city').html(city_options)
                }
            })
        }
    </script>
@endsection
