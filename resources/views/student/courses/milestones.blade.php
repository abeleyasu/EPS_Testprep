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
                        {{ $course[0]->title}}
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
                            <a class="link-fx text-dark" href="{{ route('courses.index') }}">Courses</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">
							@php
								$stringLen = strlen($course[0]->title);
							@endphp
							@if ($stringLen>30)
								@php $convetStr = substr($course[0]->title, 0, 25); @endphp
								{{$convetStr}}...
							@else
								{{$course[0]->title}}
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
                echo $description = $course[0]->description;
                @endphp
            
            
            </div>

            <div class="block-content" style="margin-bottom:20px;">
                @php
                echo $content = strip_tags($course[0]->content);
                @endphp
            
            
            </div>

            <div class="col-xl-8">
                <!-- Lessons -->
								
                
                    
                        
						@foreach($milestones as $milestone)
                        <div class="block block-rounded">
                            <div class="block-content fs-sm">
							<div class="mb-2">
								<div class="card-body row">
									<div class="col-12 colapHead" >
                                        <div class="col-11" style="float:left;">
										    <h3 style="line-height:0px;"><a href="{{ route('milestone.detail',['milestone'=>$milestone->id]) }}">{{ $milestone->name }}</a></h3>
                                        </div>
                                        <div class="col-1" style="float:left;">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="showDetail({{$milestone->id}})">
											<i class="fa-solid fa-arrow-down"></i>
										</button>
                                        </div>
                                    </div>
                                           
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
                                       
                                       
                                        if($all_tasks->count() > 0) {
                                        $tasks = $all_tasks->unique('id');
                                        $totaltask += count($tasks);
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
                                            style="background-color: blue; margin-left:-12px; width: {{$avgpercentage}}%"
                                            role="progressbar"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$avgpercentage}}%</div>
                                    </div>
                                    <br />
                                    <p>Module Progress</p>
                                    <div class="progress">
                                        <div class="progress-bar "
                                        style="background-color: blue; margin-left:-12px; width: {{$avgpercentage}}%"
                                            role="progressbar"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$completedtask}}/{{$totaltask}}</div>
                                    </div>
                                    @php
                                    }
                                    @endphp
                                @endif
                                    
								</div>
							</div>
                            </div>
                        </div>
						@endforeach
								
								
                    
                <!-- END Lessons -->
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