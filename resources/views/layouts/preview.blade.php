@extends('layouts.main')

@section('page-content')
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
  
	@include('components.user-header')
    @yield('user-content')

    @include('components.user-footer')
</div>
<!-- END Page Container -->
@endsection

@section('page-script')
    @yield('user-script')
@endsection