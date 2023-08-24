@extends('layouts.user')

@section('title', 'User Dashboard : CPS')

@section('user-content')
<!-- Main Container -->
<main id="main-container">
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(!auth()->user()->userSurvey)
            <div class="alert alert-success fade show" role="alert">
                Congratulations! You have successfully completed your profile. If you have the time, please take a moment to tell us how satisfied you are with your experience so far.
                <a href="{{ route('survey-form') }}" class="btn btn-sm btn-primary">Take Survey</a>
            </div>
        @endif
    </div>
</main>
<!-- END Main Container -->
@endsection