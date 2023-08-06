@extends('layouts.user')

@section('title', 'Student - Public High School Dashboard : Courses')

@section('user-content')
<style>
    /* .block-content img{
        max-width:100% !important;
        height:auto !important;
    } */
</style>


    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero Content -->
        <div class="bg-image"   >
            <div class="bg-primary" style="background:url({{ asset('/public/Image/'.$course->coverimage) }});background-repeat: no-repeat;background-position: center; background-size: cover">
                <div class="content content-full text-center py-7 pb-5">
                    <h1 class="h2 text-white mb-2">
                        {{ $course->title}}
                    </h1>
                    <h2 class="h4 fw-normal text-white-75">
                        {{ $totalmilestones }} Milestones
                    </h2> 
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
                        
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">
							@php
								$stringLen = strlen($course->title);
							@endphp
							@if ($stringLen>30)
								@php $convetStr = substr($course->title, 0, 25); @endphp
								{{$convetStr}}...
							@else
								{{$course->title}}
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
            {!! $course->description !!}
		</div>
		<div class="row">
            {!! $course->content !!}
		</div>
		<div class="row">
            <div class="col-xl-8">
                <!-- Lessons -->
								
						@php 
						 
						 
					
						foreach($milestones as $mkey=>$milestone){
							$totalMilestone=0;
						 $completion_percent=0;
							$completedmodule=0;
							$totalmodules=0;
							 $modulepercentage=0;
							
							$modules =  $milestone->modules();
							$totalmodules = $modules->count();
							
							$tasks =  $milestone->tasks();
							$totalTasks =  $tasks->count();
							$completeTasks =  $milestone->completeTasks(auth()->id());
							$totalCompleteTasks =  $completeTasks->count();
							 $totalMilestone=$totalMilestone+1;
							 if($totalCompleteTasks>0){
								 $completion_percent = floor(($totalCompleteTasks/$totalTasks)*100);
							 }
							 
							 
							 foreach($milestone->modules as $mmkey=>$module){
								 $mtotaltasks = $module->tasks()->count();
								 $mtotalcompletetasks = $module->completeTasks(auth()->id())->count();
								 if($mtotaltasks>0){
									 if($mtotaltasks == $mtotalcompletetasks){
										$completedmodule=$completedmodule+1;
									 }
								 }
							 }
							 if($completedmodule>0 && $totalmodules){
								$modulepercentage = floor(($completedmodule/$totalmodules)*100);	
							 }
							 
						@endphp
                        <div class="block block-rounded">
						@if($milestone->modules)
                            <div class="block-content fs-sm">
							<div class="mb-2 verticalnum">
							@php $moduleprogress ='vnumbgcolorgray'; if($modulepercentage == 100){$moduleprogress ='vnumbgcolorgreen';} @endphp
								<div class="milvnum"><span class="{{ $moduleprogress }}">{{ $mkey+1 }}</span></div>
								<div class="vcontent">
								<div class="card-body row">
									<div class="col-12 colapHead" >
                                        <div class="col-11" style="float:left;">
										    <h3>
											@if($milestone->status == 'paid' && !auth()->user()->isUserSubscibedToTheProduct($milestone->product_id))
												<a href="javascript:;" class="font-grayed">{{ $milestone->name }}</a>
											@else
											<a href="{{ route('milestone.detail',['milestone'=>$milestone->id]) }}">{{ $milestone->name }}</a>
											@endif
											
											</h3>
                                        </div>
                                        <div class="col-1" style="float:left;">
                                       <!-- <button type="button" class="btn btn-primary btn-sm" onclick="showDetail({{$milestone->id}})">
											 <i class="fa-solid fa-arrow-down"></i> 
										</button> -->
                                        </div>
                                    </div>
                                           
                                    
                                   <div class="col-8">
                                        <div class="progress">
                                            <div class="progress-bar "
                                                style="background-color: blue; width: {{$completion_percent}}%"
                                                role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                    <p>{{$completion_percent}}% Task Complete</p>
                                    </div>
                                    
                                    <div class="col-8">
                                        <div class="progress">
                                            <div class="progress-bar "
                                            style="background-color: blue; width: {{$modulepercentage}}%"
                                                role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        
                                    <p>{{$completedmodule}}/{{$totalmodules}} Module Progress</p>
                                    </div>
                                    
                                    
                                @endif
                                </div>    
								</div>
							</div>
                            </div>
                        </div>
						@php } @endphp
								
								
                     
                <!-- END Lessons -->
            </div>
			@if(isset($milestone))
            <div class="col-xl-4">
                <div class="block block-rounded">
                        <div class="block-header block-0-default text-center">
                            <h3 class="block-title">About This Course</h3>
                        </div>
                        <div class="block-content">
                            <table class="table table-striped table-borderless fs-sm">
                                <tbody>
                                <tr>
                                    <td>
                                        <i class="fa fa-fw fa-book me-1"></i>
                                        {{ $totalMilestone }} MileStones
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
                                        <i class="fa fa-fw fa-calendar me-1"></i> {{ $course->created_at->diffForHumans() }}
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
                </div>
			@endif
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