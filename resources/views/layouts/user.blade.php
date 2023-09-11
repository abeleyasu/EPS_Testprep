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
@include('components.auth.email-verification')
@endsection

@section('page-script')
    <script>
        window.addEventListener('storage', function (event) {
            const urls = [
                "{{ route('admin-dashboard.collegeApplicationDeadline') }}",
                "{{ route('admin-dashboard.initialCollegeList.step4') }}",
                "{{ route('admin-dashboard.cost_comparison') }}"
            ]
            if (event.key === 'APP-REFRESHED' && event.newValue !== event.oldValue) {
                if (urls.includes(event.srcElement.location.href)) {
                    window.location.reload();
                }
            }
        });
        $(document).ready(function () {
            const is_user_email_verified = "{{ Auth::check() ? Auth::user()->hasVerifiedEmail() : false }}";
            if (!is_user_email_verified) {
                $('#email-verification-modal').modal('show');
                $('#verfication-emaiil-alerts').html('')
                constructMessage('Please verify your email address', 'verfication-emaiil-alerts', 'danger')
            }
        })
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
            removeAllCollege: "{{ route('admin-dashboard.initialCollegeList.deleteAllCollege') }}",
            removeUserCollege: "{{ route('admin-dashboard.initialCollegeList.remove-user-college', [ 'id' => ':id' ]) }}",
        }
    </script>
    @yield('user-script')
@endsection