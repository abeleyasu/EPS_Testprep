@extends('layouts.main')

@section('title', 'Password Reset : CPS')

@section('page-content')
<div id="page-container">

    <!-- Main Container -->
    <main id="main-container">

    <!-- Page Content -->
        <div class="hero-static d-flex align-items-center">
            <div class="content">
                <div class="row justify-content-center push">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <!-- Sign In Block -->
                        <div class="block block-rounded mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Password Reset</h3>
                                <div class="block-options">
                                    <a class="btn-block-option" href="{{route('signup')}}" data-bs-toggle="tooltip" data-bs-placement="left" title="New Account">
                                        <i class="fa fa-user-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                                    <h1 class="h2 mb-1">OneUI</h1>
                                    <p class="fw-medium text-muted">
                                        Welcome, please Reset new password.
                                    </p>

                                    <!-- Sign In Form -->
                                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                    <form class="js-validation-signin" action="{{route('password.update')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ request()->route('token') }}">
                                        <input type="hidden" name="email" value="{{ request('email') }}">
                                        <div class="py-3">
                                            <div class="mb-4">
                                                <input type="password" class="form-control form-control-alt form-control-lg {{$errors->has('password') ? 'is-invalid' : ''}}" id="password" name="password" placeholder="Password">
                                                @error('password')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <input type="password" class="form-control form-control-alt form-control-lg {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" id="password_confirmation"
                                                       name="password_confirmation" placeholder="Confirm Password">
                                                @error('password_confirmation')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6 col-xl-6">
                                                <button type="submit" class="btn w-100 btn-alt-primary">
                                                    <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Reset Password
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END Sign In Form -->
                                </div>
                            </div>
                        </div>
                        <!-- END Sign In Block -->
                    </div>
                </div>
                <div class="fs-sm text-muted text-center">
                    <strong>OneUI 5.2</strong> &copy; <span data-toggle="year-copy"></span>
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
@endsection
