@extends('layouts.user')

@section('title', 'Student - Public High School Dashboard : Courses')

@section('page-style')


@endsection

@section('user-content')

<style>
    .block-content img{
        max-width:100% !important;
        height:auto !important;
    }
</style>

    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero Content -->
        <div class="bg-image"   >
            <div class="bg-primary" style="background:url({{ asset('/public/Image/'.$milestone->coverimage) }}); background-repeat: no-repeat;background-position: center; background-size: cover;">
                <div class="content content-full text-center py-7 pb-5">
                    <h1 class="h2 text-white mb-2">
                        {{ $milestone->name }}
                    </h1>
                    <h2 class="h4 fw-normal text-white-75">
                        {{ $modules->count() }} Modules
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
        @if(session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif
        <div class="row coursedesc">
            {!! $milestone->description !!}
		</div>
		<div class="row">
            {!! $milestone->content !!}
		</div>
            
            <div class="col-xl-8">
                <!-- Lessons -->
				@php
					$previouMileId=0;
					$nextExist =0;
					$sectionpercentage=0;
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
                
                    @php
						foreach($modules as $key => $module){

							$sectionpercentage = 0;					
							$completedsection = 0;
							$totaltasks = 0;
							
                            $tasks = $module->tasks();
							$totalTasks = $tasks->count();
							
                            $completeTasks = $module->completeTasks(auth()->id());
							$totalCompTasks = $completeTasks->count();
							
							$completion_percent = 0;
							$sectotaltasks = 0;
							$sectotalCompleteTasks = 0;
							if($totalTasks>0){
								$completion_percent = floor($totalCompTasks/$totalTasks * 100);
							}
							
							$sections = $module->sections;
							$totalSections = count($sections);
							$comSections=0;
								foreach($sections as $section_key => $section){
									$sectasks = $section->sectionTasks(auth()->id());
									$sectotaltasks = $sectasks->count();
									$seccompleteTasks = $section->sectionCompleteTasks(auth()->id());
									$sectotalCompleteTasks = $seccompleteTasks->count();
									if($sectotaltasks>0){
										if($sectotaltasks == $sectotalCompleteTasks){
											$comSections++;
										}
									}										
								
								}
							if($totalSections>0){
								$sectionpercentage = floor($comSections/$totalSections * 100);	
							}
							
							
							
							@endphp
                        <div class="block block-rounded">
                            <div class="block-content fs-sm">
							<div class="mb-2 verticalnum">
							@php $sectionprogress ='vnumbgcolorgray'; if($sectionpercentage == 100){$sectionprogress ='vnumbgcolorgreen';} @endphp
							<div class="modvnum"><span class="{{ $sectionprogress }}">{{ $key+1 }}</span></div>
								<div class="vcontent">
								<div class="card-body row">
									<div class="col-12 colapHead" >
                                        <div class="col-11" style="float:left;">
										    <h3 style="line-height:0px;">
																					
											@if($module->status == 'paid' && !auth()->user()->isUserSubscibedToTheProduct($module->product_id))
												<a href="javascript:;" class="font-grayed">{{ $module->title }}</a>
											@else
											<a href="{{ route('modules.detail',['module'=>$module->id]) }}">{{ $module->title }}</a>
											@endif
											</h3>
                                        </div>
                                        <div class="col-1" style="float:left; margin-top:-12px;">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="showDetail({{$module->id}})">
											<i class="fa-solid fa-arrow-down"></i>
										</button>
                                        </div>
                                    </div>
                                           
                                    
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
                                                        style="background-color: blue; width: {{$sectionpercentage}}%"
                                                        role="progressbar"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                        <div class="col-4" style="float:left;margin-left:20px;">
                                            <b>{{$comSections}}/{{$totalSections}} Section Complete</b>
                                        </div>    
                                    </div>
                                    
									
									<div class="col-12 collapse hide milestone-detail{{$module->id}}">
                                        
										@foreach($module->sections as $section_key => $section)
											<div class="my-3">
                                         
                                            
												<span class="mx-4">
																								
												@if($section->status == 'paid' && !auth()->user()->isUserSubscibedToTheProduct($section->product_id))
													<a href="javascript:;" class="font-grayed"><i class="fa-solid fa-list"></i>  {{$key+1}}.{{$section_key+1}} {!! $section->title !!}</a>
												@else
												<a href="{{ route('sections.detail',['section'=>$section->id]) }}"><i class="fa-solid fa-list"></i>  {{$key+1}}.{{$section_key+1}} {!! $section->title !!} </a>
												@endif
												</span>
												
										</div>	
										@endforeach
									</div>
								</div>
							</div>
							</div>
                            </div>
                        </div>
						@php } @endphp
								
								
                    
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
                                    {{ $modules->count() }} modules
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