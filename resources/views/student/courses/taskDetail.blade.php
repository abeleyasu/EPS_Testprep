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
