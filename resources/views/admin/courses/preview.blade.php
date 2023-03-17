@extends('layouts.preview')

@section('title', 'Student - Public High School Dashboard : Courses')

@section('page-style')


@endsection

@section('user-content')



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
                        {{ $totalmilestones }} milestones
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
                            <a class="link-fx text-dark" href="javascript:;">Courses</a>
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
        <div class="row">
            <div class="block-content" style="margin-bottom:20px;">
                @php
                echo $description = $course->description;
                @endphp
            
            
            </div>

            <div class="block-content" style="margin-bottom:20px;">
                @php
                echo $content = $course->content;
                @endphp
            
            
            </div>

            <div class="col-xl-8">
                <!-- Lessons -->
								
						@php 
						 $totalMilestone=0;
						@endphp
                    
                        
						@foreach($milestones as $milestone)
						@php 
						 $totalMilestone=$totalMilestone+1;
						@endphp
                        <div class="block block-rounded">
                            <div class="block-content fs-sm">
							<div class="mb-2">
								<div class="card-body row">
									<div class="col-12 colapHead" >
                                        <div class="col-11" style="float:left;">
										    <h3 style="line-height:0px;">
											@if($milestone->status == 'paid')
												<a href="javascript:;" class="font-grayed">{{ $milestone->name }}</a>
											@else
											<a href="javascript:;">{{ $milestone->name }}</a>
											@endif
											
											</h3>
                                        </div>
                                        <div class="col-1" style="float:left;">
                                       <!-- <button type="button" class="btn btn-primary btn-sm" onclick="showDetail({{$milestone->id}})">
											 <i class="fa-solid fa-arrow-down"></i> 
										</button> -->
                                        </div>
                                    </div>
                                           
                                    @if($milestone->modules)
                                    
                                    @php
                                    $totalmodules =  count($milestone->modules);
                                    $completion_percent = []; 
                                    $totaltask = 0;
                                    $completedtask = 0;
                                    $completedmodule = 0;
                                    @endphp
                                        @foreach($milestone->modules as $module)
                                        
                                        @php
                                         
                                        $all_tasks = $module->tasks();
                                        $totalmoduletask = count($all_tasks);
                                       
                                       
                                        if($all_tasks->count() > 0) {
                                        $tasks = $all_tasks->unique('id');
                                        $moduletask =  count($tasks);
                                        $totaltask += count($tasks);
                                        $user_tasks = $all_tasks->filter(function($item) {
                                            return $item->user_id == auth()->id() &&  $item->complete ==1;
                                        });
                                          $completemoduletask =  count($user_tasks);
                                        if($moduletask == $completemoduletask){
                                             $completedmodule += 1;
                                        }
                                        $completedtask += count($user_tasks);
                                        $user_tasks= $user_tasks->count() > 0?
                                        array_map(function ($item){
                                            return $item['id'];
                                        },$user_tasks->toArray())
                                        :
                                        [];
                                        
                                        }
                                        @endphp

                                        
                                    @endforeach

                                    @php
                                    $completion_percent = 0; 
									$modulepercentage = 0;
                                    if($totalmodules >0){
                                        $modulepercentage = ($completedmodule*100)/$totalmodules;
                                        if($totaltask){
                                            $completion_percent = floor(($completedtask * 100)/$totaltask);
                                        }else{
                                            $completion_percent = 0; 
                                        }
                                    }
                                    
                                    
                                    @endphp
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
                                    <br />
                                    <br />
                                    
                                    <div class="col-8">
                                        <div class="progress">
                                            <div class="progress-bar "
                                            style="background-color: blue; width: {{$modulepercentage}}%"
                                                role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        
                                    <p>{{$completedmodule}}/{{$totalmodules}} Module progress</p>
                                    </div>
                                    
                                    
                                @endif
                                    
								</div>
							</div>
                            </div>
                        </div>
						@endforeach
								
								
                     
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
			@endif;
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