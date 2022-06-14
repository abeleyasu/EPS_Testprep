@extends('layouts.admin')

@section('title', 'Admin Dashboard : Tasks')

@section('page-style')
    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">

    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/admin.css')}}">


@endsection

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Tasks
                </h3>
                <a href="{{ route('tasks.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus" ></i> New Task
                </a>
            </div>
            <div class="block-content block-content-full table-view">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full hidden">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Milestone</th>
                            <th>Module</th>
                            <th>Section</th>
                            <th>Position</th>
                             <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td class="fw-semibold fs-sm">{{$task->title}}</td>
                            <td class="fs-sm">
								@php 
								$stringLen = strlen($task->description);								 
								@endphp
								
								@if ($stringLen > 150)
									@php $convetStr = substr($task->description, 0, 150); @endphp
									{{$convetStr}}...
								@else
									{!! $task->description !!}
								@endif
                                
                            </td>
							<td>{{$task->section->module->milestone->name}}</td>
							<td>{{$task->section->module->title}}</td>
							<td>{{$task->section->title}}</td>
							<td>
								@php $positioncount = 0; $taskPosition=1; @endphp
								@foreach($tasks as $pkey => $positionTask)
									@if ($task->section->id == $positionTask->section->id)
										@php $positioncount++; @endphp	
										@if ($task->id == $positionTask->id)
											@php $taskPosition=$positioncount; @endphp	
										@endif
									@endif
								@endforeach
								{{$taskPosition}}/{{$positioncount}}
							</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('tasks.edit', ['task' => $task->id])}}"
                                       class="btn btn-sm btn-alt-secondary"
                                       data-bs-toggle="tooltip"
                                       title="Edit Task">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
									<a href="{{route('tasks.preview', ['task' => $task->id])}}"
                                       class="btn btn-sm btn-alt-secondary"
                                       data-bs-toggle="tooltip"
                                       title="Preview Task"
									   target="_blank"
									   >
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-alt-secondary delete-task"
                                            data-id="{{$task->id}}"
                                            data-bs-toggle="tooltip"
                                            title="Delete Task"
                                            onclick="deleteItem({{ $task->id }})"
                                    >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form id="delete-form-{{$task->id}}" action="{{ route('tasks.destroy',$task->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@endsection

@section('admin-script')

    <script>


    </script>
@endsection
