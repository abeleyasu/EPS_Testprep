@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
<style>
    .c-border {
        border: 1px solid #eee;
    }
    .image {
        width: 130px;
        height: 130px;
        object-fit: cover;
    }
    .no-data {
        border: 1px solid;
        border-style: dashed;
        border-color: darkgray;
        padding: 10px;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
    }
</style>
@endsection

@section('admin-content')
<main id="main-container">
    @php 
        $active = 'bg-success-light text-success';
        $consumed = 'bg-warning-light text-warning';
        $canceled = 'bg-warning-light text-warning';
        $faild = 'bg-danger-light text-danger';
    @endphp
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <a href="{{route('admin-user-list')}}" class="btn btn-sm btn-alt-primary me-2" data-bs-toggle="tooltip" title="back">
                    <i class="fa fa-fw fa-arrow-left-long"></i>
                </a>
                <h3 class="block-title">
                    Survey Information
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="mb-3">
                    <label for="" class="form-label">Are you a student or parent?</label>
                    <div class="row">
                        <div class="col-6 m-0">
                            <div class="form-check form-block">
                                <input class="form-check-input" type="radio" id="radio-1" name="survay_type" disabled @if($survey->survay_type == 'student') checked @endif>
                                <label class="form-check-label" for="radio-1">Student</label>
                            </div>
                        </div>
                        <div class="col-6 m-0">
                            <div class="form-check form-block">
                                <input class="form-check-input" type="radio" id="radio-2" name="survay_type" disabled @if($survey->survay_type == 'parents') checked @endif>
                                <label class="form-check-label" for="radio-2">Parents</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        @if($survey->survay_type == 'student')
                            Your Year in High School
                        @else
                            Your Student’s Year in High School.
                        @endif
                    </label>
                    <div class="form-control">
                        {{ $survey->high_school_year }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        @if($survey->survay_type == 'student')
                            What’s your parent’s email address? (when they buy College Prep System, you will get a referral reward for sharing and they’ll get a discount).
                        @else
                            What’s your student’s email address? (when they buy College Prep System, you will get a referral reward for sharing and they’ll get a discount).
                        @endif
                    </label>
                    @foreach($survey->parent_student_info as $data) 
                        <div class="form-control mb-1">
                            {{ $data->email }}
                        </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <label class="form-label">If you’d like to earn referral rewards (gift cards to Amazon, Starbucks, and more) for sharing with friends, add their email addresses here.</label>
                    @foreach($survey->friends as $data) 
                        <div class="form-control mb-1">
                            {{ $data->email }}
                        </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <label class="form-label">How did you find College Prep System?</label>
                    <div class="form-control">
                        {{ $survey->reference_path }}
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">What need specifically brought you to this site?</label>
                    <div class="form-control">
                        {{ $survey->specific_path }}
                    </div>
                    @if($survey->specific_path == 'Other')
                        <div class="form-control mt-1">
                            {{ $survey->specific_path_other_detail }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">
                    Have you found other websites that include both college admissions and test preparation in one system? If yes, which sites?  If you haven’t seen one, welcome to possibly the only all-in-one college prep system.
                    </label>
                    <div class="form-control">
                        {{ $survey->found_other_website_link }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('admin-script')
@endsection
