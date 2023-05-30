@extends('layouts.admin')

@section('title', 'Admin Dashboard : Passages')

@section('page-style')
    <style>
        .label-check{
            padding:4px;
        }
    </style>
@endsection
@section('admin-content')

    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero Content -->
        <div class="bg-image"   >
            <div class="bg-primary">
                <div class="content content-full text-center py-7 pb-5">
                    <h1 class="h2 text-white mb-2">
                        {{ $passage->title }}
                    </h1>
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
                            <a class="link-fx text-dark" href="{{ route('passages.index') }}">Passages</a>
                        </li>
                        
                    </ol>
                </nav>
            </div>
        </div>
        <!-- END Navigation -->
		
    <!-- Page Content -->
    <div class="content content-boxed">
        <div class="row">
            <div class="col-xl-5">
                <h3>Title</h3>
                {{ $passage->title}}
            </div>
            <div class="col-xl-7">
                <h3>Description</h3>
                {!! $passage->description !!}
            </div>
        </div>
    </div>
    <!-- END Page Content -->
    </main>
@endsection

@section('user-script')

<script>
function showDetail(id) {
            $('.milestone-detail'+id).collapse('toggle')
        }
        function showSectionDetail(id) {
            $('.section-detail'+id).collapse('toggle')
        }

</script>
@endsection