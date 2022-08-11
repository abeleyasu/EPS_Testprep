@extends('layouts.user')

@section('title', 'Student Dashboard : Courses')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
    <style>
        /*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/
        /* Timeline holder */
        ul.timeline {
            list-style-type: none;
            position: relative;
            padding-left: 1.5rem;
        }
        /* Timeline vertical line */
        ul.timeline:before {
            content: ' ';
            background: lightgray;
            display: inline-block;
            position: absolute;
            left: 16px;
            width: 4px;
            height: 100%;
            z-index: 400;
            border-radius: 1rem;
        }
        li.timeline-item {
            margin: 20px 0;
        }
        /* Timeline item circle marker */
        li.timeline-item::before {
            content: ' ';
            background: #6c6c6c;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 20px solid lightgray;
            left: 0;
            width: 14px;
            height: 14px;
            z-index: 400;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .round {
            position: relative;
            width: 28px;
            height: 28px;
        }
        .round label {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 50%;
            cursor: pointer;
            height: 28px;
            left: 0;
            position: absolute;
            top: 0;
            width: 28px;
        }
        .round label:after {
            border: 2px solid #fff;
            border-top: none;
            border-right: none;
            content: "";
            height: 6px;
            left: 7px;
            opacity: 0;
            position: absolute;
            top: 8px;
            transform: rotate(-45deg);
            width: 12px;
        }
        .round input[type="checkbox"] {
            position: relative;
            z-index: 9;
            opacity: 0;
            width: 100%;
            height: 100%;
        }
        .round input[type="checkbox"]:checked+label {
            background-color: #66bb6a;
            border-color: #66bb6a;
        }
        .round input[type="checkbox"]:checked+label:after {
            opacity: 1;
        }
    </style>


@endsection

@section('user-content')
<!-- Main Container -->
<main id="main-container">
<div class="block-header block-header-default">
                <h3 class="block-title">
                    Courses
                    <span class="btn-group" style="margin-left: 40%">
                        <button class="btn grid-btn"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Grid View">
                            <i class="fa-solid fa-table"></i>
                        </button>
                        <button class="btn table-btn"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Table View">
                            <i class="fa-solid fa-table-cells"></i>
                        </button>
                    </span>
                </h3>
                
            </div>
    <!-- Page Content -->
    <div class="row grid-view px-2">
        <div class="content content-boxed">

                <div class="row items-push py-4">
                    @php
						
						foreach($courses as $key => $course){
							$completion_percent = 0; 
							$totaltask = 0;
							$completedtask = 0;
							
							$totaltask = $course->tasks()->count();
							if($totaltask>0){
								$completedtask = $course->completeTasks(auth()->id())->count();
								$completion_percent = floor(($completedtask/$totaltask)*100);
							}    
                    @endphp
                        <!-- Course -->
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            @if($course->status == 'paid')
								<a class="block block-rounded block-link-pop h-100 mb-0" href="javascript:;">

                                <div class="block-content block-content-full text-center bg-grayed">

                                    <div class="btn-group float-end ">
                                        <span class="badge bg-dark">Paid</span>
                                    </div>
                                    
                                    <div class="item item-2x item-circle bg-white-10 py-3 my-3 mx-auto">
                                    {{--                                <i class="fab fa-html5 fa-2x text-white-75"></i>--}}
                                    </div>
                                    @php
                                    
                                    @endphp
                                    <div class="fs-sm text-black">
                                         {{$totalmilestone[$course->id]['total_milestone']}} milestones
                                    </div>
                                </div>
                                <div class="block-content block-content-full">
                                    <h4 class="h5 mb-1">
                                        {{ $course->title }}
                                    </h4>
                                    <div class="row mb-2">
										<div class="col-12">
											<div class="progress coursesBar" style="background:#c4c5c7;">
													<div class="progress-bar "
														style="background-color: blue; width: {{ $completion_percent }}%"
														role="progressbar"
														aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
                                    <div class="fs-sm text-muted">{{ $course->created_at->format( 'M d, Y') }}</div>
                                    
                                </div>
                            </a>
							@else
								<a class="block block-rounded block-link-pop h-100 mb-0" href="{{ route('courses.milestone',['course' => $course->id]) }}">

                                <div class="block-content block-content-full text-center {{ \App\Constants\AppConstants::BG_CLASS[$key%11] }}">

                                    <div class="item item-2x item-circle bg-white-10 py-3 my-3 mx-auto">
                                    {{--                                <i class="fab fa-html5 fa-2x text-white-75"></i>--}}
                                    </div>
                                    @php
                                    
                                    @endphp
                                    <div class="fs-sm text-white-75">
                                         {{$totalmilestone[$course->id]['total_milestone']}} milestones
                                    </div>
                                </div>
                                <div class="block-content block-content-full">
                                    <h4 class="h5 mb-1">
                                        {{ $course->title }}
                                    </h4>
                                    <div class="row mb-2">
										<div class="col-12">
											<div class="progress" style="background:#c4c5c7;">
													<div class="progress-bar "
														style="background-color: blue; width:{{ $completion_percent }}%"
														role="progressbar"
														aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
                                    <div class="fs-sm text-muted">{{ $course->created_at->format( 'M d, Y') }}</div>
                                    
                                </div>
                            </a>
							@endif
                        
                            
                        </div>
                        <!-- END Course -->
                    @php } @endphp
                </div>

        </div>
    
    
    
    </div>

 
   
</main>
<!-- END Main Container -->
@endsection

@section('user-script')

<script>
        var gridDiv = $('.grid-view');
        var tableDiv = $('.table-view');
        var gridBtn = $('.grid-btn');
        var tableBtn = $('.table-btn');
        $(document).ready(() => {
            tableDiv.hide();
            gridDiv.show();
            tableBtn.addClass("btn-outline-primary");
            gridBtn.addClass("btn-primary");
            tableBtn.click(function () {
                tableDiv.show();
                gridDiv.hide();
                tableBtn.removeClass("btn-outline-primary");
                tableBtn.addClass("btn-primary");
                gridBtn.removeClass("btn-primary");
                gridBtn.addClass("btn-outline-primary");
            })
            gridBtn.click(function () {
                tableDiv.hide();
                gridDiv.show();
                tableBtn.removeClass("btn-primary");
                tableBtn.addClass("btn-outline-primary");
                gridBtn.removeClass("btn-outline-primary");
                gridBtn.addClass("btn-primary");
            })
        })
        function removeOpacity(evt) {
            $(evt).removeClass('opacity-100')
        }
        function addOpacity(evt) {
            $(evt).addClass('opacity-100')
        }
        function showDetail(id) {
            $('.milestone-detail'+id).collapse('toggle')
        }
        function changeStatus(id) {
            $('#task-status-form-'+id).submit();
        }
    </script>
@endsection