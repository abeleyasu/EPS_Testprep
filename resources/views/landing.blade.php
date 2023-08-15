@extends('layouts.home')

@section('title', 'College Prep System : CPS')

@section('main-content')

@include('landing-page-component.home')
@include('landing-page-component.about')
@include('landing-page-component.our-process')
@include('landing-page-component.our-blog')
@include('landing-page-component.our-testimonial')
@include('landing-page-component.our-apps')
@include('landing-page-component.bg-counters')
{{--- @include('landing-page-component.pricing')
@include('landing-page-component.our-partners') --}}
@include('landing-page-component.stayconnect')

@endsection

@section('home-style')
<link rel="stylesheet" href="{{ asset('css/plan.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/fancybox/jquery.fancybox.min.css') }}">
<style>
  
</style>
@endsection

@section('home-script')
<script src="{{ asset('assets/js/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('js/landingpage.js') }}"></script>
@endsection
