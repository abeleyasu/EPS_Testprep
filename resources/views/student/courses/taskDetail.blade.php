.@extends('layouts.user')

@section('title', 'Student - Public High School Dashboard : Courses')

@section('page-style')



@endsection

@section('user-content')
<!-- Main Container -->
<main id="main-container">


    <!-- Hero Content -->
    <div class="bg-image"   >
        <div class="bg-primary">
            <div class="float-start">
                <button class="btn " style="background-color: grey">Task</button>
            </div>
            <div class="content content-full text-center py-7 pb-5">
                <h1 class="h2 text-white mb-2">
                    {{ $task->title }}
                </h1>

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
						
						<a class="link-fx text-dark" href="{{ route('milestone.detail',['milestone' => $module->milestone_id]) }}">
						@php
							$stringLen = strlen($milestone->name);							
						@endphp
						@if ($stringLen>25)
							@php $convetStr = substr($milestone->name, 0, 25); @endphp
							{{$convetStr}}...
						@else
							{{$milestone->name}}
						@endif	
						</a>
					</li>
					<li class="breadcrumb-item">
						<a class="link-fx text-dark" href="{{ route('modules.detail',['module'=>$module->id]) }}">
						@php
							$stringLen1 = strlen($module->title);
							
						@endphp
						@if ($stringLen1>25)
							@php $convetStr1 = substr($module->title, 0, 25); @endphp
							{{$convetStr1}}...
						@else
							{{$module->title}}
						@endif
						</a>
					</li>						
					<li class="breadcrumb-item">
						<a class="link-fx text-dark" href="{{ route('sections.show-detail',['section'=>$section->id]) }}">
						@php
							$stringLen2 = strlen($section->title);
							
						@endphp
						@if ($stringLen2>25)
							@php $convetStr2 = substr($section->title, 0, 25); @endphp
							{{$convetStr2}}...
						@else
							{{$section->title}}
						@endif
						</a>
					</li>	
					<li class="breadcrumb-item" aria-current="page">
						<a class="link-fx" href="javascript:;">
						@php
							$stringLen3 = strlen($task->title);
							
						@endphp
						@if ($stringLen3>30)
							@php $convetStr3 = substr($task->title, 0, 25); @endphp
							{{$convetStr3}}...
						@else
							{{$task->title}}
						@endif			
						</a>
					</li>
				</ol>
			</nav>
		</div>
	</div>
		
    <div class="row pt-2" style="width: 99%">
        <div class="col-lg-9 col-md-9 col-sm-12 mx-auto">
            <form action="{{ route('tasks.change_status',['task'=>$task->id]) }}" method="post">
                @csrf
                @if($task->authTaskStatus() && $task->authTaskStatus()->status == 1)
                <button type="submit" class="btn btn-primary float-end btn-sm" >
                    Mark InComplete
                </button>
                    @else
                    <button type="submit" class="btn btn-success float-end btn-sm" >
                        Mark Complete
                    </button>
                    @endif
            </form>
        </div>
    </div>

        <div class=" py-5">

            <div class="row" style="width: 99%">
                <div class="col-lg-9 col-md-9 col-sm-12 mx-auto">
					@php
						$previouMileId=0;
						$nextExist =0;
						$lastItem = count($gettasks)-1;
					@endphp
					@foreach($gettasks as $tkey => $gettask)
						@if ($task->id == $gettask->id)
							@if ($tkey>0)
								<a href="{{ route('tasks.detail',['task'=>$previouModId]) }}" class="btn w-25 btn-alt-success">
									<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Previous Task
								</a>	
							@endif
							@if ($tkey ==0 && count($gettasks)>1)
								<a href="{{ route('tasks.detail',['task'=>$gettasks[1]->id]) }}" class="btn w-25 btn-alt-success">
										<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Task
									</a>
							@endif
							@if ($lastItem == $tkey)
								<a href="{{ route('sections.show-detail',['section'=>$gettask->section_id]) }}" class="btn w-25 btn-alt-success">
										<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Section
								</a>
							@endif
						@endif
						
					@php 
						$previouModId = $gettask->id; 
					@endphp	
						@if ($nextExist>0)
							@php $nextExist =0; @endphp
							<a href="{{ route('tasks.detail',['task'=>$gettask->id]) }}" class="btn w-25 btn-alt-success">
									<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Task
								</a>
						@endif
						@if ($task->id == $gettask->id)
							@if ($tkey>0)
								@php
									$nextExist =1;
								@endphp	
							@endif
						@endif
						
					@endforeach	
                    <div class="card">
                        <div class="card-body">
                            <p>{!! $task->description !!}</p>
                        </div>
                    </div>


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
