@extends('layouts.main')

@section('title', 'Forget Password : CPS')

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
                                <h3 class="block-title">Forget Password</h3>
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
                                        Welcome, please Enter Email to receive reset code.
                                    </p>

                                    <!-- Sign In Form -->
                                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                    <form class="js-validation-signin" action="{{route('password.email')}}" method="POST">
                                        @csrf
                                        <div class="py-3">
                                            <div class="mb-4">
                                                <input type="text" class="form-control form-control-alt form-control-lg {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                                                @error('email')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6 col-xl-6">
                                                <button type="submit" class="btn w-100 btn-alt-primary">
                                                    <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Forget Password
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
