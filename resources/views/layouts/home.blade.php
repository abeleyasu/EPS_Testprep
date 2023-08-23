@extends('layouts.main')

@section('page-content')
<div id="page-container">
    <main id="main-container">
        @include('components.landing-page.header')
        @yield('main-content')
        @include('components.landing-page.footer')
    </main>
</div>
@include('landing-page-component.modals.auth.signin-modal')
@include('landing-page-component.modals.auth.signup-modal')
@include('components.auth.terms')
@include('components.auth.email-verification')
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
    <script>
        $(document).ready(function () {
            const session_status = "{{ session()->get('email_status') }}";
            const session_message = "{{ session()->get('email_message') }}";
            const session_modal = "{{ session()->get('modal') }}";
            const user = @json(Auth::check());
            if (session_status == 'error' && session_modal == 'email-verification-modal' && user) {
                $('#email-verification-modal').modal('show');
                $('#verfication-emaiil-alerts').html('')
                constructMessage(session_message, 'verfication-emaiil-alerts', 'danger')
            }
            if (session_status == 'success' && session_modal == 'login') {
                $('#sign-in-modal').modal('show');
                $('#errors').html('')
                constructMessage(session_message, 'errors', 'success')
            }

            $('#signin').on('click', function (e) {
                e.preventDefault();
                const form = $("form[class*='js-validation-signin']");
                if (form.valid()) {
                    $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    }).done((response) => {
                    if (response.success) {
                        window.location.href = response.redirect_url
                    } else {
                        $('#errors').html('')
                        if (response.data) {    
                            let error = response.message + '<br>'
                            error += '<a class="text-primary" data-id="'+response.data.id+'" id="resend-verification-link-login-modal">Reset Email Verification Link</a>';
                            constructMessage(error, 'errors', 'danger')
                        } else {
                            constructMessage(response.message, 'errors', 'danger')
                        }
                    }
                    })
                }
            })
        })
        $(document).on('click', '#resend-verification-link-login-modal', async function (e) {
            e.preventDefault();
            const response = await resetEmailVerfication($(this).data('id'));
            if (response.success) {
                $('#errors').html('')
                constructMessage(response.message, 'errors', 'success')
            } else {
                $('#errors').html('')
                constructMessage(response.message, 'errors', 'danger')
            }
        })
    </script>
    @yield('home-script')
@endsection