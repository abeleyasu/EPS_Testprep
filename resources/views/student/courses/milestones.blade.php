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
                    Milestones
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
                    @foreach($milestones as $key => $milestone)
                        <!-- Course -->
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <a class="block block-rounded block-link-pop h-100 mb-0" href="{{ route('milestone.detail',['milestone' => $milestone->id]) }}">

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
                                    @if($milestone->modules)
                                    @php
                                    $completion_percent = []; 
                                    $totaltask = 0;
                                    $completedtask = 0;
                                    @endphp
                                        @foreach($milestone->modules as $module)
                                        @php
                                    
                                        $all_tasks = $module->tasks();
                                        $totalmoduletask = count($all_tasks);
                                        $totaltask += $totalmoduletask;
                                       
                                        if($all_tasks->count() > 0) {
                                        $tasks = $all_tasks->unique('id');
                                        $user_tasks = $all_tasks->filter(function($item) {
                                            return $item->user_id == auth()->id() &&  $item->complete ==1;
                                        });
                                        $completedtask += count($user_tasks);
                                        $user_tasks= $user_tasks->count() > 0?
                                        array_map(function ($item){
                                            return $item['id'];
                                        },$user_tasks->toArray())
                                        :
                                        [];
                                        $completion_percent[] = floor(count($user_tasks)/$tasks->count() * 100);
                                        }
                                        @endphp

                                        
                                    @endforeach

                                    @php
                                    
                                        $totalmodule = count($completion_percent);
                                        if($totalmodule > 0){
                                            $summodule = 0;
                                        foreach($completion_percent as $percentage){
                                            $summodule += $percentage;
                                        }
                                        $avgpercentage = floor($summodule/$totalmodule);
                                        
                                       
                                        
                                    @endphp
                                    
                                    <div class="progress">
                                        <div class="progress-bar "
                                            style="background-color: #db3954; width: {{$avgpercentage}}%"
                                            role="progressbar"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$avgpercentage}}%</div>
                                    </div>
                                    <br />
                                    <p>Module Progress</p>
                                    <div class="progress">
                                        <div class="progress-bar "
                                        style="background-color: #db3954; width: {{$avgpercentage}}%"
                                            role="progressbar"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$completedtask}}/{{$totaltask}}</div>
                                    </div>
                                    @php
                                    }
                                    @endphp
                                @endif
                                
                                </div>
                            </a>
                        </div>
                        <!-- END Course -->
                    @endforeach
                </div>

        </div>
    
    
    
    </div>

    <div class="block-content block-content-full table-view">
   
    <ul class="timeline" style="position:inherit;">
                    @foreach($milestones as $key => $milestone)
                        <li class="timeline-item bg-white rounded ml-3 p-4 shadow"
                            style="margin-left: 10%">

                            <div class="row">
                            <div class="col-9">
                                <a href="{{ route('milestone.detail',['milestone' => $milestone->id]) }}">{{ $milestone->name }}</a>
                                <div class="fs-sm text-muted">{{ $milestone->created_at->format( 'M d, Y') }}</div>

                            </div>
                            
                            <ul class="timeline" style="position:inherit;">
                            @if($milestone->modules)
                            @php
                            $totaltask = 0;
                            $completion_percent = [];
                            @endphp
                                    @foreach($milestone->modules as $module)
                                        @php
                                    
                                        $all_tasks = $module->tasks();
                                        $totalmoduletask = count($all_tasks);
                                        $totaltask += $totalmoduletask;
                                        if($all_tasks->count() > 0) {
                                        $tasks = $all_tasks->unique('id');
                                        $user_tasks = $all_tasks->filter(function($item) {
                                            return $item->user_id == auth()->id() &&  $item->complete ==1;
                                        });
                                        $user_tasks= $user_tasks->count() > 0?
                                        array_map(function ($item){
                                            return $item['id'];
                                        },$user_tasks->toArray())
                                        :
                                        [];
                                        $completion_percent[] = floor(count($user_tasks)/$tasks->count() * 100);
                                        }
                                        @endphp
                                    @endforeach

                                    
                                @endif

                    </ul><!-- End --> 
                            </div>
                        </li>
                        @endforeach

                    </ul><!-- End -->
    </div>
    <!-- END Page Content -->
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