@extends('layouts.user')

@section('title', 'Student - Public High School Dashboard : Courses')

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
    <div class="content content-boxed">

        <div class="row items-push py-4">

            @foreach($milestones as $key => $milestone)
                <!-- Course -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <a class="block block-rounded block-link-pop h-100 mb-0" href="{{ route('courses.detail',['milestone' => $milestone->id]) }}">

                        <div class="block-content block-content-full text-center {{ \App\Constants\AppConstants::BG_CLASS[$key%11] }}">

                            @if($milestone->status == 'paid')
                            <div class="btn-group float-end ">
                                <span class="badge bg-dark">Paid</span>
                            </div>
                            @endif
                            <div class="item item-2x item-circle bg-white-10 py-3 my-3 mx-auto">
{{--                                <i class="fab fa-html5 fa-2x text-white-75"></i>--}}
                            </div>
                            <div class="fs-sm text-white-75">
                                {{ $milestone->modules->count() }} modules
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <h4 class="h5 mb-1">
                                {{ $milestone->name }}
                            </h4>
                            <div class="fs-sm text-muted">{{ $milestone->created_at->format( 'M d, Y') }}</div>
                        </div>
                    </a>
                </div>
                <!-- END Course -->
            @endforeach
            </div>

    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@endsection

@section('user-script')

    <script>


    </script>
@endsection
