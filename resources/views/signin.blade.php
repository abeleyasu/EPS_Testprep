@extends('layouts.main')

@section('title', 'Sign In : CPS')

@section('page-content')
<div id="page-container">
 
    <!-- Main Container -->
    <main id="main-container">
        <div class="position-fixed d-flex align-items-end w-100 justify-content-end p-3">
            <a href="{{ route('simple-pricing') }}" class="btn btn-alt-primary">Pricing</a>
        </div>
    <!-- Page Content -->
    @php
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
    @endphp
        <div class="hero-static d-flex align-items-center">
            <div class="content">
                <div class="row justify-content-center push">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <!-- Sign In Block -->
                        <div class="block block-rounded mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Sign In</h3>
                                <div class="block-options">
                                    <a class="btn-block-option fs-sm" href="{{ route('password.request') }}">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                                    @if (session('email_verified_success'))
                                        <div class="alert alert-success d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fa fa-fw fa-check"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-0">
                                                    {{session('email_verified_success')}}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <h1 class="h2 mb-1">{{ config('app.app_name') }}</h1>
                                    <p class="fw-medium text-muted">
                                        Welcome, please login.
                                    </p>

                                    <!-- Sign In Form -->
                                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                    @include('components.auth.signin')
                                    <!-- END Sign In Form -->
                                </div>
                            </div>
                        </div>
                        <!-- END Sign In Block -->
                    </div>
                </div>
                <div class="fs-sm text-muted text-center">
                    <div class="mb-2">
                        Don’t have an account? Register
                        <a class="" href="{{route('signup')}}" data-bs-toggle="tooltip" data-bs-placement="left" title="New Account">
                            here
                        </a>.
                    </div>
                    <strong>{{ config('app.app_name') }}</strong> &copy; <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->
@endsection

<!-- Page Script -->
@section('page-script')
<script src="{{asset('assets/js/pages/op_auth_signin.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('form[class*="js-validation-signin"]')[0].reset()
    })
</script>
@endsection
