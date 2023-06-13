@extends('layouts.main')

@section('page-content')
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
    <div id="page-loader" class="show"></div>
    @include('components.user-nav')
    @include('components.user-header')

    @yield('user-content')

    @include('components.user-footer')
</div>
<!-- END Page Container -->
@endsection

@section('page-script')
    <script>
        window.addEventListener('storage', function (event) {
            if (event.key === 'APP-REFRESHED' && event.newValue !== event.oldValue) {
                window.location.reload();
            }
        });
        const core = {
            hidecollegeurl: "{{ route('admin-dashboard.initialCollegeList.changeSearchCollegeAddStatus', [ 'id' => ':id' ]) }}",
            gethideCollegeUrl: "{{ route('admin-dashboard.initialCollegeList.getHideCollege') }}"
        }
    </script>
    @yield('user-script')
@endsection