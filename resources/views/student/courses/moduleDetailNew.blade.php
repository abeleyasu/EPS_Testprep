@extends('layouts.user')

@section('title', 'Student - Public High School Dashboard : Courses')


@section('page-style')


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
        .number_count {
        height: 45px;
        width: 45px;
        background-color: #1f2937;
        border-radius: 50%;
        display: inline-block;
        color: #fff;
        font-size: 24px;
        line-height: 44px;
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


    <!-- Hero Content -->
    <div class="bg-image"   >
        <div class="bg-primary">
            <div class="float-start">Module</div>
            <div class="content content-full text-center py-7 pb-5">
                <h1 class="h2 text-white mb-2">
                    {{ $module->title }}
                </h1>
                <h2 class="h4 fw-normal text-white-75">
                    {{ $module->sections->count() }} sections
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
					<li class="breadcrumb-item">
						<a class="link-fx text-dark" href="{{ route('courses.detail',['milestone' => $module->milestone_id]) }}">
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
						
					<li class="breadcrumb-item" aria-current="page">
						<a class="link-fx" href="javascript:;">
							@php
								$stringLen1 = strlen($module->title);
							@endphp
							@if ($stringLen1>30)
								@php $convetStr1 = substr($module->title, 0, 25); @endphp
								{{$convetStr1}}...
							@else
								{{ $module->title }}
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
						$lastItem = count($getModules)-1;
					@endphp
					@foreach($getModules as $mokey => $getModule)
						@if ($module->id == $getModule->id)
							@if ($mokey>0)
								<a href="{{ route('modules.detail',['module'=>$previouModId]) }}" class="btn w-25 btn-alt-success">
									<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Previous Module
								</a>	
							@endif
							@if ($mokey ==0 && count($getModules)>1)
								<a href="{{ route('modules.detail',['module'=>$getModules[1]->id]) }}" class="btn w-25 btn-alt-success">
										<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Module
									</a>
							@endif
							@if ($lastItem == $mokey)
								<a href="{{ route('courses.detail',['milestone' => $getModule->milestone_id]) }}" class="btn w-25 btn-alt-success">
										<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Milstone
								</a>
							@endif

						@endif
					@php 
						$previouModId = $getModule->id; 
					@endphp	
						@if ($nextExist>0)
							@php $nextExist =0; @endphp
							<a href="{{ route('modules.detail',['module'=>$getModule->id]) }}" class="btn w-25 btn-alt-success">
									<i class="fa fa-fw fa-eye me-1 opacity-50"></i> Next Module
								</a>
						@endif
						@if ($module->id == $getModule->id)
							@if ($mokey>0)
								@php
									$nextExist =1;
								@endphp	
							@endif
						@endif
						
					@endforeach	

                    
                    <p>{!! $module->description !!}</p>
                    <p>{!! $module->content !!}</p>
                    <!-- Timeline -->
                    <ul class="timeline" style="position:inherit;padding-left:0px;">

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

        var module_id = '{{ $module->id }}';
        var user = '{{ auth()->id() }}';
        var first_time = true;
        $(document).ready(() => {
            populateTasks();
        });

        function populateTasks() {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/modules/${module_id}/sections-all`,
                data: {user_id: user},
                method: 'post',
                success: (res) => {
                    $('.timeline').empty();
                    var j = 1;
                    res.data.forEach(i => {

                        
                        $(`<li class="timeline-item bg-white rounded ml-3 p-4 shadow" style="">
                         <div class="row" id="row-${i.id}">
                                    <div class="col-1 number_count">`+j+`</div>
                                    <div class="col-8">
                                        <a href="/user/sections/${i.id}/show-detail">${i.title}</a>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn  btn-sm float-end" onclick="showDetail(${i.id})">
                                              <i class="fa-solid fa-arrow-down"></i>
                                        </button>
                                    </div>
                                </div>
                        </li>`).appendTo('.timeline');
                        if(i.tasks ) {
                            // $(`task-head-${i.id}`)?.remove();
                            // $(`section-detail${i.id}`)?.remove();
                            $(`<div class="col-12" id="task-head-${i.id}">
                                  <div class="row">
                                  <div class=" col-0"></div>
                                             <div class=" col-8">
                                                 <div class="progress" style="margin-left:45px;">
                                                     <div class="progress-bar "
                                                          style="background-color: lightgray; width: ${i.completion_rate}%"
                                                          role="progressbar"
                                                          aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                 </div>

                                              </div>
                                              <div class="col-3">
                                                  Task Complete ${i.completion_rate} %
                                              </div>
                                  </div>
                            </div>
                            <div class="col-12 collapse hide section-detail${i.id}">

                            </div>`).appendTo(`#row-${i.id}`);
                            let _data = typeof i.tasks === 'object' ? Object.values(i.tasks) : i.tasks;
                            _data.forEach((task) => {
                                $(`<div class="my-2" style="margin-left:15px;">
                                      <div class="row">
                                          <div class="round" onclick="changeStatus(${task.id},${i.id})" >
                                              <input type="checkbox" id="checkbox${task.id}" ${Object.values(i.user_tasks).includes(task.id)?'checked':''}/>
                                              <label for="checkbox${task.id}"></label>
                                          </div>
                                          <div class="col">
                                              <a href="#">
                                                ${task.title}
                                              </a>
                                          </div>
                                      </div>
                                  </div>`).appendTo(`.section-detail${i.id}`);
                            })
                        }
                        j++;
                    });

                }
            });
        }

        function showDetail(id ) {
            $('.section-detail'+id).collapse('toggle');
        }

        function changeStatus(task, section) {

            if(first_time) {
                first_time = false;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `/api/task/${task}/change-status`,
                    data: {user_id: user},
                    method: 'post',
                    success: (res) => {
                        console.log(res);
                        populateTasks();
                        // setTimeout(() => { showDetail(section);},100);
                        first_time = true;
                    }
                });
            }

        }
    </script>
@endsection
