@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
<style>
    .c-border {
        border: 1px solid #eee;
    }
    .image {
        width: 130px;
        height: 130px;
        object-fit: cover;
    }
    .no-data {
        border: 1px solid;
        border-style: dashed;
        border-color: darkgray;
        padding: 10px;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
    }
</style>
@endsection

@section('admin-content')
<main id="main-container">
    @php 
        $active = 'bg-success-light text-success';
        $consumed = 'bg-warning-light text-warning';
        $canceled = 'bg-warning-light text-warning';
        $faild = 'bg-danger-light text-danger';
    @endphp
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <a href="{{route('admin-user-list')}}" class="btn btn-sm btn-alt-primary me-2" data-bs-toggle="tooltip" title="back">
                    <i class="fa fa-fw fa-arrow-left-long"></i>
                </a>
                <h3 class="block-title">
                    User Information
                </h3>
                <span class="fs-sm fw-medium rounded text-center px-3 py-2 {{ \App\Constants\AppConstants::STRIPE_STATUS_COLOR_CODE[$user->is_active ? 'active' : 'failed'] }}" id="status">
                    {{ $user->is_active ? 'Active' : 'Deactive' }}
                </span>
            </div>
            <div class="block-content block-content-full">

                <div class="mb-2 d-flex align-items-start gap-2">
                    @php 
                        $src = asset('assets/media/avatars/no-user-image.png'); 
                        if ($user->profile_pic) {
                            $src = asset('profile_images/' . $user->profile_pic);
                        }
                    @endphp
                    <img src="{{ $src }}" class="image" alt="">
                </div>
                <!-- Personal Information block start -->
                <div class="block block-rounded c-border">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Personal Information</h3>
                        <a href="{{route('admin-edit-user', ['id' => $user->id])}}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit User">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                        </a>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-bordered">
                            <tr>
                                <th>User Name</th>
                                <td colspan="3">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>First Name</th>
                                <td>{{ $user->first_name }}</td>

                                <th>Last Name</th>
                                <td>{{ $user->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>{{ $user->userrole->name }}</td>

                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Mobile Number</th>
                                <td>{{ $user->phone }}</td>

                                <th>Parent Phone Number</th>
                                <td>{{ $user->parent_phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Active/Deactive User</th>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" @if($user->is_active) checked @endif>
                                    </div>
                                </td>
                                
                                <th>Stripe Customer Id</th>
                                <td>{{ $user->stripe_id ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>{{ $user->state() ? $user->state()->state_name : '-' }}</td>

                                <th>City</th>
                                <td>{{ $user->city() ? $user->city()->city_name : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Address line 1</th>
                                <td colspan="3">{{ $user->address_line_1 ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Address line 2</th>
                                <td colspan="3">{{ $user->address_line_2 ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Postal Code</th>
                                <td colspan="3">{{ $user->postal_code ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Personal Information block end -->

                <!-- Subscription Information block start -->
                <div class="block block-rounded c-border">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Subscription Information</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="block block-rounded c-border">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Active Subscription Information</h3>
                            </div>
                            <div class="block-content block-content-full">
                                @if($active_subscription)
                                    <table class="table table-bordered">
                                        <tr align="center">
                                            <th colspan="4">Subscription Details</th>
                                        </tr>
                                        <tr>
                                            <th>Product Name</th>
                                            <td>{{ $active_subscription['product_title'] }}</td>
        
                                            <th>Monthly Price</th>
                                            <td>{{ $active_subscription['monthly_price'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Subscription Id</th>
                                            <td>{{ $active_subscription['stripe_id'] }}</td>
        
                                            <th>Subscription Amount</th>
                                            <td>{{ $active_subscription['amount'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Subscription Start Date</th>
                                            <td>{{ $active_subscription['created_at'] }}</td>
        
                                            <th>Subscription End Date</th>
                                            <td>{{ $active_subscription['ends_at'] ?? '-'  }}</td>
                                        </tr>
                                        <tr>
                                            <th>Next Billing Date</th>
                                            <td>{{ $active_subscription['is_active_automatic_renewal'] ? '-' : $active_subscription['next_billing_date'] ?? '-' }}</td>
        
                                            <th>Next Billing Amount</th>
                                            <td>{{ $active_subscription['is_active_automatic_renewal'] ? '-' : $active_subscription['amount'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Subscription Status:</th>
                                            <td>
                                                <span class="fs-sm fw-medium rounded text-center px-3 py-2 text-capitalize {{ \App\Constants\AppConstants::STRIPE_STATUS_COLOR_CODE[$active_subscription['stripe_status']] }}">
                                                    {{ $active_subscription['stripe_status'] }}
                                                </span>
                                            </td>
                                            
                                            <th>Enable automatic renewal</th>
                                            <td><span class="fs-sm fw-medium rounded text-center px-3 py-2 {{ \App\Constants\AppConstants::STRIPE_STATUS_COLOR_CODE[!$active_subscription['is_active_automatic_renewal'] ? 'active' : 'failed'] }}">
                                                {{ !$active_subscription['is_active_automatic_renewal'] ? 'Active' : 'Deactive' }}
                                            </span></td>
                                        </tr>
                                        <tr align="center">
                                            <th colspan="4">Billing Details</th>
                                        </tr>
                                        <tr>
                                            <th>Card Holder Name</th>
                                            <td colspan="3">{{ $active_subscription['billing_details']['name'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $active_subscription['billing_details']['email'] }}</td>
        
                                            <th>Mobile Number</th>
                                            <td>{{ $active_subscription['billing_details']['phone'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Card Number (Last 4 digit)</th>
                                            <td>{{ $active_subscription['card']['last4'] }}</td>
        
                                            <th>Card Expiration Date</th>
                                            <td>{{ $active_subscription['card']['exp_month'] }}/{{ $active_subscription['card']['exp_year'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Card Brand</th>
                                            <td>{{ $active_subscription['card']['brand'] }}</td>
        
                                            <th>Card Country</th>
                                            <td>{{ $active_subscription['card']['country'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <td>{{ $active_subscription['billing_details']['address']['state'] }}</td>
        
                                            <th>City</th>
                                            <td>{{ $active_subscription['billing_details']['address']['city'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address line 1</th>
                                            <td colspan="3">{{ $active_subscription['billing_details']['address']['line1'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address line 2</th>
                                            <td colspan="3">{{ $active_subscription['billing_details']['address']['line2'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Postal Code</th>
                                            <td colspan="3">{{ $active_subscription['billing_details']['address']['postal_code'] }}</td>
                                        </tr>
                                    </table>
                                @else
                                    <div class="no-data">
                                        No Active Subscription Found
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="block block-rounded c-border">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Cancel Subscription History</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                        <tr>
                                            <th>Subscription Product</th>
                                            <th>Subscription Id</th>
                                            <th>Amount</th>
                                            <th>Interval</th>
                                            <th>Status</th>
                                            <th>End Date</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cancel_failed_subscription as $subscription) 
                                            <tr>
                                                <td>{{ $subscription->plan->product->title }}</td>
                                                <td>{{ $subscription->stripe_id }}</td>
                                                <td>{{ number_format($subscription->plan->amount) }}</td>
                                                <td>{{ $subscription->plan->interval_count }} {{ $subscription->plan->interval }}</td>
                                                <td>
                                                    <span class="fs-sm fw-medium rounded text-center px-3 py-2 text-capitalize {{ \App\Constants\AppConstants::STRIPE_STATUS_COLOR_CODE[$subscription->stripe_status] }}">
                                                        {{ $subscription->stripe_status }}
                                                    </span>
                                                </td>
                                                <td>{{ $subscription->ends_at ? \Carbon\Carbon::parse($subscription->ends_at)->format('m-d-Y H:i:s') : '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($subscription->created_at)->format('m-d-Y H:i:s') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.subscription.subscription-info', ['id' => $subscription['stripe_id']]) }}" class="btn btn-sm btn-alt-primary view-information" data-bs-toggle="tooltip" title="View Information">
                                                            <i class="fa fa-fw fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="block block-rounded c-border">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Subscription History</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                        <tr>
                                            <th>Subscription Product</th>
                                            <th>Subscription Id</th>
                                            <th>Amount</th>
                                            <th>Interval</th>
                                            <th>Status</th>
                                            <th>Pending Hours</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hourly_subscription as $subscription) 
                                            <tr>
                                                <td>{{ $subscription->plan->product->title }}</td>
                                                <td>{{ $subscription->stripe_id }}</td>
                                                <td>{{ number_format($subscription->plan->amount) }}</td>
                                                <td>{{ $subscription->plan->interval_count }} {{ $subscription->plan->interval }}</td>
                                                <td>
                                                    <span class="fs-sm fw-medium rounded text-center px-3 py-2 text-capitalize {{ \App\Constants\AppConstants::STRIPE_STATUS_COLOR_CODE[$subscription->stripe_status] }}">
                                                        {{ $subscription->stripe_status }}
                                                    </span>
                                                </td>
                                                <td> {{ number_format($subscription->pending_consumed_hours, 2) }} </td>
                                                <td>{{ \Carbon\Carbon::parse($subscription->created_at)->format('m-d-Y H:i:s') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.subscription.subscription-info', ['id' => $subscription['stripe_id']]) }}" class="btn btn-sm btn-alt-primary view-information" data-bs-toggle="tooltip" title="View Information">
                                                            <i class="fa fa-fw fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="block block-rounded c-border">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">User Card Information</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                        <tr>
                                            <th>Card Holder Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Card Last 4 digit</th>
                                            <th>Expiration</th>
                                            <th>Card Brand</th>
                                            <th>Card Country</th>
                                            <th>Funding</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cards as $card)
                                            <tr>
                                                <td>{{ $card->billing_details->name }}</td>
                                                <td>{{ $card->billing_details->email }}</td>
                                                <td>{{ $card->billing_details->phone }}</td>
                                                <td>{{ $card->card->last4 }}</td>
                                                <td>{{ $card->card->exp_month }}/{{ $card->card->exp_year }}</td>
                                                <td>{{ $card->card->brand }}</td>
                                                <td>{{ $card->card->country }}</td>
                                                <td>{{ $card->card->funding }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Subscription Information block end -->
            </div>
        </div>
    </div>
</main>
@endsection

@section('admin-script')
<script>
    $('input[type="checkbox"]').change(function(e){
        const url = core.updateUserStatus.replace(':id', @json($user->id));
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change this user status!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then(async (result) => {
            if (result.isConfirmed) {
                const response = await updateUserStatus(url);
                if (response.success) {
                    toastr.success(response.message);
                    if (response.data) {
                        $('#status').text('Active');
                        $('#status').removeClass('bg-danger-light text-danger');
                        $('#status').addClass('bg-success-light text-success');
                    } else {
                        $('#status').text('Deactive');
                        $('#status').removeClass('bg-success-light text-success');
                        $('#status').addClass('bg-danger-light text-danger');
                    }
                } else {
                    toastr.error(response.message);
                    $(this).prop('checked', !$(this).prop('checked'));
                }
            } else {
                $(this).prop('checked', !$(this).prop('checked'));
            }
        })
    });
</script>
@endsection
