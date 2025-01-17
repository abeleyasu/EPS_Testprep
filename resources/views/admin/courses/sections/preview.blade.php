@extends('layouts.preview')

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
		.dispalytask_list{
			font-size: 17px;
			text-transform:uppercase;
			display:flex;
			line-height: 27px;
		}
		.dispalytask_list .round {
			margin-right:10px;
		}
    </style>

@endsection

@section('user-content')
<!-- Main Container -->
<main id="main-container">


    <!-- Hero Content -->
    <div class="bg-image"   >
        <div class="bg-primary" style="background:url({{ asset('/public/Image/'.$section->coverimage) }}); background-repeat: no-repeat;background-position: center;background-size: cover;">
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
						<a class="link-fx text-dark" href="javascript:;">Courses</a>
					</li>
                    <li class="breadcrumb-item">
						<a class="link-fx text-dark" href="javascript:;">@if(isset($course[0])) {{$course[0]->title}} @endif</a>
					</li>
					
					<li class="breadcrumb-item">
						<a class="link-fx text-dark" href="javascript:;">
							@php
							if($milestone){
								$stringLen = strlen($milestone->name);
							
								if ($stringLen>25){
									$convetStr = substr($milestone->name, 0, 25);
									echo $convetStr.'...';
								}else{
									echo $milestone->name;
								}
							}								
							@endphp							
						</a>
					</li>
					<li class="breadcrumb-item">
						<a class="link-fx text-dark" href="javascript:;">	
						@php
						if(isset($module)){
							$stringLen1 = strlen($module->title);
							if ($stringLen1>25){
								$convetStr1 = substr($module->title, 0, 25);
								echo $convetStr1.'...';
							}else{
								echo $module->title;
							}
						}
							
						@endphp
						
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
	<div class="content content-boxed">
        <div class="row">
			<div class="block-content" style="margin-bottom:20px;">
                @php
                echo $description = $section->description;
                @endphp
            
            
            </div>

            <div class="block-content" style="margin-bottom:20px;">
                @php
                echo $content = $section->content;
                @endphp            
            
            </div>
		
			<div class="col-xl-8">
					@php
						$previouMileId=0;
						$nextExist =0;
						$lastItem = count($getSections)-1;
					@endphp
					@foreach($getSections as $skey => $getSection)
						@if ($section->id == $getSection->id)
							@if ($skey>0)
								<a href="javascript:;" class="btn w-25 btn-alt-success">
									<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Previous Section
								</a>	
							@endif
							@if ($skey ==0 && count($getSections)>1)
								<a href="javascript:;" class="btn w-25 btn-alt-success">
										<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Section
								</a>
							@endif
							@if ($lastItem == $skey)
								<a href="javascript:;" class="btn w-25 btn-alt-success">
										<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Module
								</a>
							@endif
						@endif
						@php 
							$previouSecId = $getSection->id; 
						@endphp	
							@if ($nextExist>0)
								@php $nextExist =0; @endphp
								<a href="javascript:;" class="btn w-25 btn-alt-success">
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
					@foreach($tasks as $key=>$task)
						<div class="block block-rounded">
								<div class="block-content fs-sm">
								<div class="mb-2">
									<div class="card-body row">
										<div class="col-12 colapHead" >
											<div class="col-11" style="float:left;">
											@if($task->status == 'paid')
												<div class="dispalytask_list">
												<div class="round" >
													<input type="checkbox">
													<label for="checkbox{{$task->id}}"></label>
												</div>
												<a href="javascript:;" class="font-grayed" >
												{{ $task->title }}
												</a>
												</div>
											@else
											<div class="dispalytask_list">
												<div class="round" >
													<input type="checkbox">
													<label for="checkbox{{$task->id}}"></label>
												</div>
												<a href="/admin/course-management/tasks/{{ $task->id }}/preview"> {{ $task->title }} </a>
												</div>
											@endif
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
					@endif
			</div>
			<div class="col-xl-4">
				<!-- Subscribe -->
{{--                <div class="block block-rounded">--}}
{{--                    <div class="block-content">--}}
{{--                        <a class="btn btn-primary w-100 mb-2" href="javascript:void(0)">Subscribe from $9/month</a>--}}
{{--                        <p class="fs-sm text-center">--}}
{{--                            or <a class="link-effect fw-medium" href="javascript:void(0)">buy this course for $28</a>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- END Subscribe -->

                <!-- Course Info -->
                <div class="block block-rounded">
                    <div class="block-header block-0-default text-center">
                        <h3 class="block-title">About This Section</h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-striped table-borderless fs-sm">
                            <tbody>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-book me-1"></i>
                                    {{ $section->tasks->count() }} tasks
                                </td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <i class="fa fa-fw fa-clock me-1"></i> 3 hours--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <i class="fa fa-fw fa-heart me-1"></i> 16850 Favorites--}}
{{--                                </td>--}}
{{--                            </tr>--}}
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-calendar me-1"></i> {{ $section->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-tags me-1"></i>
                                    @foreach($section->tags() as $tag)
                                        <a class="fw-semibold link-fx text-primary" href="javascript:void(0)">{{ $tag->name }}</a>,
                                    @endforeach
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Course Info -->

                <!-- About Instructor -->
{{--                <a class="block block-rounded block-link-shadow" href="javascript:void(0)">--}}
{{--                    <div class="block-header block-header-default text-center">--}}
{{--                        <h3 class="block-title">About The Instructor</h3>--}}
{{--                    </div>--}}
{{--                    <div class="block-content block-content-full text-center">--}}
{{--                        <div class="push">--}}
{{--                            <img class="img-avatar" src="assets/media/avatars/avatar11.jpg" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="fw-semibold mb-1">Jose Parker</div>--}}
{{--                        <div class="fs-sm text-muted">Front-end Developer</div>--}}
{{--                    </div>--}}
{{--                </a>--}}
                <!-- END About Instructor -->
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
