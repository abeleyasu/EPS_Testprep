@extends('layouts.user')

@section('title', 'Student Dashboard : Courses')

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
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">@php
                                $title = explode(' ',$milestone->name);
                                echo "$title[0] ". $title[1] ?? '';
                                        @endphp</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- END Navigation -->
    <!-- Page Content -->
    <div class="content content-boxed">
        <div class="row">
            <div class="col-xl-8">
                <!-- Lessons -->
                <div class="block block-rounded">
                    <div class="block-content fs-sm">
                        @foreach($milestone->modules as $key => $module)

                            
                        <!-- Introduction -->
                        <table class="table table-borderless table-vcenter">
                            <tbody>
                            <tr class="table-active">
                                <th style="width: 50px;"></th>
                                <th>
                                    <a href="{{ route('modules.detail',['module'=>$module->id]) }}">{{$key+1}}. {{ $module->title }}</a>
                                </th>

                                <th>
                                    @php
                                    
                                        $all_tasks = $module->tasks();
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
                            
                                    <div class="progress" style="background:#c4c5c7;">
                                                <div class="progress-bar "
                                                     style="background-color: blue; width: {{$completion_percent}}%"
                                                     role="progressbar"
                                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$completion_percent}}%</div>
                                            </div>
                                          
                                </th>
                                <th class="text-end">
                                    <span class="text-muted">

                                    </span>
                                </th>
                            </tr>
                            @foreach($module->sections as $section_key => $section)
                            <tr>
                                <td class="table-success text-center">
                                    <i class="fa fa-fw fa-unlock text-success"></i>
                                </td>
                                <td>
                                    <a class="fw-medium"
                                       href="{{ route('sections.detail',['section'=>$section->id]) }}">
                                        {{$key+1}}.{{$section_key+1}} {{ $section->title }}</a>
                                </td>
                                <td>
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
                                <div class="progress" style="background:#c4c5c7;">
                                                <div class="progress-bar "
                                                     style="background-color: blue; width: {{$completion_percent}}%"
                                                     role="progressbar"
                                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$completion_percent}}%</div>
                                            </div>
                                </td>
                                <td class="text-end text-muted">

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- END Introduction -->
                        @endforeach
                    </div>
                </div>
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
                    <div class="block-header block-header-default text-center">
                        <h3 class="block-title">About This Course</h3>
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
        </div>
    </div>
    <!-- END Page Content -->
    </main>
@endsection

@section('user-script')

@endsection
