@extends('layouts.main')

@section('title', 'Verify Email : CPS')

@section('page-content')
<div id="page-container">
    <main id="main-container">
        <div class="d-flex justify-content-end p-3">
            <a href="{{ route('signout') }}" class="btn btn-alt-success">logout</a>
        </div>
        <div class="hero-static d-flex align-items-center">
            <div class="content">
                <div class="row justify-content-center push">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="block block-rounded mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title d-flex justify-content-center">{{ __('Verify Your Email Address') }}</h3>
                            </div>
                            <div class="block-content">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif
                                <div class="p-sm-1 px-lg-2 px-xxl-3 py-lg-3">
                                    <p class="fw-medium text-muted">
                                        {{ __('Before proceeding, please check your email for a verification link.') }}
                                    </p>
                                    <p class="fw-medium text-muted">{{ __('If you did not receive the email') }},</p>
                                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit" class="btn w-100 btn-alt-success">{{ __('Click here to request another') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
