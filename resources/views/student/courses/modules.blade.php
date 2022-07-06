@extends('layouts.user')

@section('title', 'Student - Public High School Dashboard : Courses')

@section('page-style')


@endsection

@section('user-content')

    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero Content -->
        <div class="bg-image"   >
            <div class="bg-primary">
                <div class="content content-full text-center py-7 pb-5">
                    <h1 class="h2 text-white mb-2">
                        {{ $milestone->name }}
                    </h1>
                    <h2 class="h4 fw-normal text-white-75">
                        {{ $milestone->modules->count() }} modules
                    </h2>
                </div>
            </div>
        </div>
        <!-- END Hero Content -->

        <!-- Navigation -->
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

                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">
							@php
								$stringLen = strlen($milestone->name);
							@endphp
							@if ($stringLen>30)
								@php $convetStr = substr($milestone->name, 0, 25); @endphp
								{{$convetStr}}...
							@else
								{{$milestone->name}}
							@endif			
							</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- END Navigation -->
    <!-- Page Content -->
    <div class="content content-boxed">
        <div class="row">
            <div class="block-content" style="margin-bottom:20px;">
                @php
                echo $description = $milestone->description;
                @endphp
            
            
            </div>

            <div class="block-content" style="margin-bottom:20px;">
                @php
                echo $content = strip_tags($milestone->content);
                @endphp
            
            
            </div>
            
            <div class="col-xl-8">
                <!-- Lessons -->
				@php
					$previouMileId=0;
					$nextExist =0;
				@endphp
					@foreach($getMilestones as $mkey => $getMilestone)
						@if ($milestone->id == $getMilestone->id)
							@if ($mkey>0)
								<a href="{{ route('milestone.detail',['milestone' => $previouMileId]) }}" class="btn w-30 btn-alt-success btnminwidth">
									<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Previous Milestone
								</a>	
							@endif
							@if ($mkey ==0 && count($getMilestones)>1)
								<a href="{{ route('modules.detail',['module'=>$getMilestones[1]->id]) }}" class="btn w-25 btn-alt-success btnminwidth">
										<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Module
								</a>
							@endif
						@endif
					@php 
						$previouMileId = $getMilestone->id; 
					@endphp	
						@if ($nextExist>0)
							@php $nextExist =0; @endphp
							<a href="{{ route('milestone.detail',['milestone' => $getMilestone->id]) }}" class="btn w-25 btn-alt-success btnminwidth">
									<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Milestone
								</a>
						@endif
						@if ($milestone->id == $getMilestone->id)
							@if ($mkey>0)
								@php
									$nextExist =1;
								@endphp	
							@endif
						@endif
						
					@endforeach				
                
                    
						@foreach($milestone->modules as $key => $module)

                        @php
                        $completedsection = 0;
                        $totaltasks = 0;
                        @endphp
                        @foreach($module->sections as $section_key => $section)
                        @php
                        $all_tasks = $section->taskStatus();
                            $completion_percent = 0;
                            $all_tasks->count();
                            if($all_tasks->count() > 0) {
                            $tasks = $all_tasks->unique('id');
                            $sectiontask =  count($tasks);
                            $totaltasks += 1;
                            $user_tasks = $all_tasks->filter(function($item) {
                                return $item->user_id == auth()->id() &&  $item->complete ==1;
                            });
                            $sectioncompletedtask =  $user_tasks->count();
                            if($sectiontask == $sectioncompletedtask){
                                $completedsection += 1;
                            }
                            }
                                            
                                                
                        @endphp
                        @endforeach
                        <div class="block block-rounded">
                            <div class="block-content fs-sm">
							<div class="mb-2">
								<div class="card-body row">
									<div class="col-12 colapHead" >
                                        <div class="col-11" style="float:left;">
										    <h3 style="line-height:0px;"><a href="{{ route('modules.detail',['module'=>$module->id]) }}">{{$key+1}}. {{ $module->title }}</a></h3>
                                        </div>
                                        <div class="col-1" style="float:left; margin-top:-12px;">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="showDetail({{$module->id}})">
											<i class="fa-solid fa-arrow-down"></i>
										</button>
                                        </div>
                                    </div>
                                           
                                    @php
                                    
                                    $all_tasks = $module->tasks();
                                    
                                    
                                    $completion_percent = 0;
                                    $completedtask = 0;
                                    $moduletask = 0;
                                    if($all_tasks->count() > 0) {
                                    $tasks = $all_tasks->unique('id');
                                    $moduletask = count($tasks);
                                    
                                    $user_tasks = $all_tasks->filter(function($item) {
                                        return $item->user_id == auth()->id() &&  $item->complete ==1;
                                    });
                                    $completedtask = count($user_tasks);
                                    
                                    $user_tasks= $user_tasks->count() > 0?
                                    array_map(function ($item){
                                        return $item['id'];
                                    },$user_tasks->toArray())
                                    :
                                    [];
                                    $completion_percent = floor(count($user_tasks)/$tasks->count() * 100);
                                    }
                                    @endphp
                                    <div class="col-12" style="margin-bottom:20px;">
                                        <div class="col-7" style="float:left;">
                                            <div class="progress" style="background:#c4c5c7;">
                                                    <div class="progress-bar "
                                                        style="background-color: blue; width: {{$completion_percent}}%"
                                                        role="progressbar"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-4" style="float:left;margin-left:20px;">
                                            <b>{{$completion_percent}}% Task Complete</b>
                                        </div>    
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="col-7" style="float:left;">
                                            <div class="progress" style="background:#c4c5c7;">
                                                    <div class="progress-bar "
                                                        style="background-color: blue; width: {{$completion_percent}}%"
                                                        role="progressbar"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                        <div class="col-4" style="float:left;margin-left:20px;">
                                            <b>{{$completedsection}}/{{$totaltasks}} Section Complete</b>
                                        </div>    
                                    </div>
                                    
									
									<div class="col-12 collapse hide milestone-detail{{$module->id}}">
                                        
										@foreach($module->sections as $section_key => $section)
											<div class="my-3">
                                                
                                        @php
                                        $all_tasks = $section->taskStatus();
                                            $completion_percent = 0;
                                            $all_tasks->count();
                                            if($all_tasks->count() > 0) {
                                            $tasks = $all_tasks->unique('id');
                                            $sectiontask =  count($tasks);
                                            $user_tasks = $all_tasks->filter(function($item) {
                                                return $item->user_id == auth()->id() &&  $item->complete ==1;
                                            });
                                            $sectioncompletedtask =  $user_tasks->count();
                                            $user_tasks= $user_tasks->count() > 0?
                                            array_map(function ($item){
                                                return $item['id'];
                                            },$user_tasks->toArray())
                                            :
                                            [];
                                            $completion_percent = floor(count($user_tasks)/$tasks->count() * 100);
                                            }
                                        
                                            
                                        @endphp
                                            
												<span class="mx-4"><a href="{{ route('sections.detail',['section'=>$section->id]) }}"><i class="fa-solid fa-list"></i> </span> {{$key+1}}.{{$section_key+1}} {!! $section->title !!} </a></span>
												
										</div>	
										@endforeach
									</div>
								</div>
							</div>
                            </div>
                        </div>
						@endforeach
								
								
                    
                <!-- END Lessons -->
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
                        <h3 class="block-title">About This Milestone</h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-striped table-borderless fs-sm">
                            <tbody>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-book me-1"></i>
                                    {{ $milestone->modules->count() }} modules
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
                                    <i class="fa fa-fw fa-calendar me-1"></i> {{ $milestone->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-tags me-1"></i>
                                    @foreach($milestone->tags() as $tag)
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
        
    <!-- END Page Content -->
    </main>
@endsection

@section('user-script')

@endsection
<script>
function showDetail(id) {
            $('.milestone-detail'+id).collapse('toggle')
        }
        function showSectionDetail(id) {
            $('.section-detail'+id).collapse('toggle')
        }

</script>