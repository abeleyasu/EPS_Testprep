@extends('layouts.user')

@section('title', 'Student - Public High School Dashboard : Courses')

@section('page-style')

    <style>
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


    <!-- Hero Content -->
    <div class="bg-image"   >
        <div class="bg-primary" style="background:url({{url('/public/Image/')}}/{{$section->coverimage}}); background-repeat: no-repeat;background-position: center;">
            <div class="float-start">Section</div>
            <div class="content content-full text-center py-7 pb-5">
                <h1 class="h2 text-white mb-2">
                    {{ $section->title }}
                </h1>
{{--                <h2 class="h4 fw-normal text-white-75">--}}
{{--                    {{ $section->task->count() }} sections--}}
{{--                </h2>--}}
            </div>
        </div>
    </div>
    <!-- END Hero Content -->
	<div class="bg-body-extra-light">
		<div class="content content-boxed py-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-alt">
					<li class="breadcrumb-item">
						<a class="link-fx text-dark" href="{{ route('courses.index') }}">Courses</a>
					</li>
                    <li class="breadcrumb-item">
						<a class="link-fx text-dark" href="/user/courses/{{$course[0]->id}}/milestone">{{$course[0]->title}}</a>
					</li>
					
					<li class="breadcrumb-item">
						<a class="link-fx text-dark" href="{{ route('milestone.detail',['milestone' => $milestone->id]) }}">
							@php
								$stringLen = strlen($milestone->name);
							@endphp
							@if ($stringLen>25)
								@php $convetStr = substr($milestone->name, 0, 25); @endphp
								{{$convetStr}}...
							@else
								{{ $milestone->name }}
							@endif	
						</a>
					</li>
					<li class="breadcrumb-item">
						<a class="link-fx text-dark" href="{{ route('modules.detail',['module'=>$section->module_id]) }}">	
						@php
							$stringLen1 = strlen($module->title);
						@endphp
						@if ($stringLen1>25)
							@php $convetStr1 = substr($module->title, 0, 25); @endphp
							{{$convetStr1}}...
						@else
							{{ $module->title}}
						@endif
						</a>
					</li>	
					<li class="breadcrumb-item" aria-current="page">
						<a class="link-fx" href="javascript:;">
						@php
							$stringLen2 = strlen($section->title);
						@endphp
						@if ($stringLen2>30)
							@php $convetStr2 = substr($section->title, 0, 25); @endphp
							{{$convetStr2}}...
						@else
							{{$section->title}}
						@endif			
						</a>
					</li>
				</ol>
			</nav>
		</div>
	</div>

        <div class=" py-5">

            <div class="row" style="width: 99%">
                <div class="col-lg-9 col-md-9 col-sm-12 mx-auto">
					@php
						$previouMileId=0;
						$nextExist =0;
						$lastItem = count($getSections)-1;
					@endphp
					@foreach($getSections as $skey => $getSection)
						@if ($section->id == $getSection->id)
							@if ($skey>0)
								<a href="{{ route('sections.show-detail',['section'=>$previouSecId]) }}" class="btn w-25 btn-alt-success">
									<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Previous Section
								</a>	
							@endif
							@if ($skey ==0 && count($getSections)>1)
								<a href="{{ route('sections.show-detail',['section'=>$getSections[1]->id]) }}" class="btn w-25 btn-alt-success">
										<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Section
								</a>
							@endif
							@if ($lastItem == $skey)
								<a href="{{ route('modules.detail',['module'=>$getSection->module_id]) }}" class="btn w-25 btn-alt-success">
										<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Module
								</a>
							@endif
						@endif
					@php 
						$previouSecId = $getSection->id; 
					@endphp	
						@if ($nextExist>0)
							@php $nextExist =0; @endphp
							<a href="{{ route('sections.show-detail',['section'=>$getSection->id]) }}" class="btn w-25 btn-alt-success">
									<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Section
							</a>
						@endif
						@if ($section->id == $getSection->id)
							@if ($skey>0)
								@php
									$nextExist =1;
								@endphp	
							@endif
						@endif
						
					@endforeach	

                    <p>{!! $section->description !!}</p>


                                @php

                                    $all_tasks = $section->taskStatus();
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

                                <div class=" milestone-detail{{$section->id}}" style="margin-left:11px;">
                                            @foreach($tasks as $task)

                                                <div class="my-2 section-detail{{$section->id}}">
                                                    <div class="row">
                                                        <div class="round" onclick="changeStatus({{ $task->id }})" >
                                                            <input type="checkbox" id="checkbox{{$task->id}}"
                                                                   @if(in_array($task->id,$user_tasks))checked
                                                                   @endif/>
                                                            <label for="checkbox{{$task->id}}"></label>
                                                            <form action="{{ route('tasks.change_status',['task'=>$task->id])}}" style="display: none"
                                                                  id="task-status-form-{{$task->id}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="{{$section->module->milestone->id}}" name="course_id" />
                                                            </form>
                                                        </div>
                                                        <div class="col">
                                                            <a href="{{ route('tasks.detail',['task'=>$task->id]) }}">
                                                            {!! $task->title !!}
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>

                                            @endforeach

                                </div>

                                @endif
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
