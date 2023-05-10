@extends('layouts.user')

@section('title', 'Plans : CPS')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">

<style>
	.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection

@section('user-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Subscriptions List</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Interval</th>
                            <th>Interval Count</th>
                            <th>Currency</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th style="width: 15%;">Auto Renew</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($subscriptions as $subscription){ ?>
                        	<tr>
                        <td>{{ $subscription->product_title[0]['title'] }}</td>
                        <td>{{ $subscription->plan['interval'] }}</td>
                        <td>{{ $subscription->plan['interval_count'] }}</td>
                        <td>{{ $subscription->plan['currency'] }}</td>
                        <td>{{ $subscription->plan['amount'] }}</td>
                        <td>{{ $subscription->stripe_status }}</td>
                        <td>
                        	<div class="btn-group">
                        		<label class="switch">
                        			@if($subscription->ends_at == null)
                        			<input type="checkbox" id="switcher" checked value="{{$subscription->name}}">
                        			@else
                        			<input type="checkbox" id="switcher" value="{{$subscription->name}}">
                        			@endif
                        			<span class="slider round"></span>
                        		</label>
                                <!-- <button type="button" class="btn btn-sm btn-alt-secondary delete-user" data-id="{{$subscription->stripe_id}}" data-bs-toggle="tooltip" title="Delete User">
                                    <i class="fa fa-fw fa-times"></i>
                                </button> -->
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                         <!-- print_r($subscription->plan['product_id']);
                         die; -->
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // $('.delete-user').click(function(){
        //     if(confirm("Are you sure to cancel this subscription?") == true){
        //         $.ajax({
        //             'url': "{{route('mysubscriptions.cancel')}}",
        //             'type': "POST",
        //             'data': {id: $(this).data('id')},
        //             'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        //         }).done(function(data){
        //             document.location.reload();
        //         });
        //     }
        // });

        $(document).ready(function(){
        	$("#switcher").click(function(){
        		var subscriptionName = $('#switcher').val();
        		if($(this).is(':checked')){
        			$.ajax({
                    'url': "{{route('mysubscriptions.resume')}}",
                    'type': "GET",
                    'data': {subscriptionName},
                    'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(response){
                    	console.log(response)
                    }
                })
        		} else {
        			$.ajax({
                    'url': "{{route('mysubscriptions.cancel')}}",
                    'type': "GET",
                    'data': {subscriptionName},
                    'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(response){
                    	console.log(response)
                    }
                })
        		// 	.done(function(data){
                //     // document.location.reload();
                // });
        		}
        	});
        });
    </script>
@endsection
