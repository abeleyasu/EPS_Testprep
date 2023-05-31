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

        <div class=" py-5">

            <div class="row" style="width: 99%">
                <div class="col-lg-9 col-md-9 col-sm-12 mx-auto">

                    <div class="mb-2">
                        <h2><b>{{ $milestone->name }}</b></h2>
                    </div>
                    <h3><b>Modules</b></h3>
                    <!-- Timeline -->
                    <ul class="timeline" style="position:inherit;">
                        @foreach($milestone->modules as $module)
                        <li class="timeline-item bg-white rounded ml-3 p-4 shadow"
                            style="margin-left: 10%">

                            <div class="row">
                            <div class="col-9">
                                {{ $module->title }}
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn  btn-sm float-end" onclick="showDetail({{$module->id}})">
                                    <i class="fa-solid fa-arrow-down"></i>
                                </button>
                            </div>


                                @php
                                    $all_tasks = $module->tasks();
                                    $completion_percent = 0;
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
                                    $completion_percent = floor(count($user_tasks)/$tasks->count() * 100);
                                    }
                                @endphp
                                @if($all_tasks->count() > 0 && isset($tasks))
                                <div class="col-12">
                                    <div class="row mt-5">
                                        <div class=" col-8">
                                            <div class="progress">
                                                <div class="progress-bar "
                                                     style="background-color: lightgray; width: {{$completion_percent}}%"
                                                     role="progressbar"
                                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                        </div>
                                        <div class="col-4">
                                            Task Complete {{ $completion_percent }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 collapse hide milestone-detail{{$module->id}}">





                                            @foreach($tasks as $task)

                                                <div class="mx-6 my-2 section-detail{{$module->id}}">
                                                    <div class="row">
                                                        <div class="round" onclick="changeStatus({{ $task->id }})" >
                                                            <input type="checkbox" id="checkbox{{$task->id}}"
                                                                   @if(in_array($task->id,$user_tasks))checked
                                                                   @endif/>
                                                            <label for="checkbox{{$task->id}}"></label>
                                                            <form action="{{ route('tasks.change_status',['task'=>$task->id])}}" style="display: none"
                                                                  id="task-status-form-{{$task->id}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="{{$milestone->id}}" name="course_id" />
                                                            </form>
                                                        </div>
                                                        <div class="col">{!! $task->title !!}</div>
                                                    </div>

                                                </div>

                                            @endforeach

                                </div>

                                @endif
                            </div>
                        </li>
                        @endforeach

                    </ul><!-- End -->

                </div>
            </div>
        </div>


    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@endsection

@section('user-script')

    <script>
        function showDetail(id) {
            $('.milestone-detail'+id).collapse('toggle')
        }
        function changeStatus(id) {
            $('#task-status-form-'+id).submit();
        }
    </script>
@endsection