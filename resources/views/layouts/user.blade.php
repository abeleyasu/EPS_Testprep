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
            gethideCollegeUrl: "{{ route('admin-dashboard.initialCollegeList.getHideCollege') }}",
            collegelustUrl: "{{ route('admin-dashboard.collegeApplicationDeadline.collegeList') }}",
            applicationOrganizer: "{{ route('admin-dashboard.getApplicationDeadlineData') }}",
            getSingleApplicationOrganizer: "{{ route('admin-dashboard.getSingleApplicationData', [ 'id' => ':id' ]) }}",
            pastCurrentScore: "{{ route('admin-dashboard.initialCollegeList.getPastCurrentScore', [ 'id' => ':id' ]) }}",
            getSinglePastCurentScore: "{{ route('admin-dashboard.initialCollegeList.getSinglePastCurrentScore', [ 'id' => ':id' ]) }}",
            deletepastCurrentScore: "{{ route('admin-dashboard.initialCollegeList.deletePastCurrentScore', [ 'id' => ':id' ]) }}",
            updateScoreDetails: "{{ route('admin-dashboard.initialCollegeList.step3.saveAcademicStatistics', ['score' => ':score', 'id' => ':id']) }}",
            intltelinput: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
            updateCollegeOrder: "{{ route('admin-dashboard.initialCollegeList.step4.updateOrder', ['id' => ':id']) }}",
            costComparisonDetail: "{{route('admin-dashboard.cost_comparison.get_college_list_for_cost_comparison')}}",
        }
    </script>
    @yield('user-script')
@endsection