@extends('layouts.user')

@section('title', 'Student Dashboard : Courses')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">



@endsection

@section('user-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Courses

                </h3>
            </div>

            <div class="row grid-view px-2">

                @foreach($milestones as $milestone)
                    <div class=" col-md-3 my-2 col-sm-6">
                        <div class="card pointer-event">
                            <a href="{{ route('courses.detail',['$milestone' => $milestone]) }}">
                            <div class="card-body bg-default ">
                                <div style="min-height: 200px">

                                    @if($milestone->status == 'paid')
                                    <div class="btn-group float-end ">
                                        <span class="badge bg-dark">Paid</span>
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <h5 class="m-lg-2">
                                {{ $milestone->name }}
                            </h5>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@endsection

@section('user-script')

    <script>


    </script>
@endsection
