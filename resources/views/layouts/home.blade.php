@extends('layouts.main')

@section('page-content')
<div id="page-container">
    <main id="main-container">
        <div class="loader">
            <div class="loader-inner">
                <div class="cssload-loader"></div>
            </div>
        </div>
        @include('components.landing-page.header')
        @yield('main-content')
        @include('components.landing-page.footer')
    </main>
</div>
@include('landing-page-component.modals.auth.signin-modal')
@include('landing-page-component.modals.auth.signup-modal')
<!-- END Page Container -->
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/owal-carousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    @yield('home-style')
@endsection

@section('page-script')
    <script src="{{ asset('assets/_js/pages/be_ui_animations.js') }}"></script>
    <script src="{{ asset('assets/js/owal-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('js/home-common.js') }}"></script>
    @yield('home-script')
@endsection