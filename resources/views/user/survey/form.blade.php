@extends('layouts.user')

@section('title', 'User Dashboard : CPS')

@section('page-style')
    <style>
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
@endsection

@section('user-content')
<main id="main-container">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="block block-rounded">
                    <div class="block-header block-header-default block-header-main">
                        <h3 class="block-title">Survey Form</h3>
                    </div>
                    <div class="block-content">
                        @if(session('error'))
                            <div class="alert alert-danger fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('survey-form-submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Are you a student or parent?</label>
                                <div class="row">
                                    <div class="col-6 m-0">
                                        <div class="form-check form-block">
                                            <input class="form-check-input {{$errors->has('survay_type') ? 'is-invalid' : ''}}" type="radio" value="student" id="radio-1" name="survay_type" checked>
                                            <label class="form-check-label" for="radio-1">Student</label>
                                        </div>
                                    </div>
                                    <div class="col-6 m-0">
                                        <div class="form-check form-block">
                                            <input class="form-check-input {{$errors->has('survay_type') ? 'is-invalid' : ''}}" type="radio" value="parents" id="radio-2" name="survay_type">
                                            <label class="form-check-label" for="radio-2">Parents</label>
                                        </div>
                                    </div>
                                </div>
                                @error('survay_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="high_school_year" class="form-label">Your Year in High School</label>
                                <select name="high_school_year" id="high_school_year" class="form-control {{$errors->has('high_school_year') ? 'is-invalid' : ''}}">
                                    <option value="">Select option</option>
                                    @foreach($high_school_year as $year)
                                        <option value="{{ $year }}" @selected(old('high_school_year') == $year)>{{ $year }}</option>
                                    @endforeach
                                </select>
                                @error('high_school_year')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="parent_student_emails" class="form-label">
                                    <span>What’s your parent’s email address? (when they buy College Prep System, you will get a referral reward for sharing and they’ll get a discount). </span>
                                    <span class="btn btn-alt-success btn-sm cursor-pointer add-parent-student-email"><i class="fa fa-plus" ></i></span>
                                </label>
                                <div id="parent_student_emails_holder">
                                    @if(old('parent_student_emails') && count(old('parent_student_emails')) > 0)
                                        @foreach(old('parent_student_emails') as $key => $old)
                                            <div class="mb-2">
                                                <div class="d-flex gap-2">
                                                    @php 
                                                        $error_key = 'parent_student_emails.' . $key
                                                    @endphp
                                                    <input type="text" name="parent_student_emails[]" value="{{ $old }}" class="form-control parent-student-email {{$errors->has($error_key) ? 'is-invalid' : 'dsfsf'}}" placeholder="Enter email address">
                                                    <span class="btn btn-alt-danger cursor-pointer remove-parent-student-email"><i class="fa fa-minus"></i></span>
                                                </div>
                                                @if($errors->has($error_key)) 
                                                    <div class="text-danger">{{ $errors->first($error_key) }}</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="mb-2">
                                            <div class="d-flex gap-2">
                                                <input type="text" name="parent_student_emails[0]" class="form-control parent-student-email" placeholder="Enter email address">
                                                <span class="btn btn-alt-danger cursor-pointer remove-parent-student-email"><i class="fa fa-minus" ></i></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="friends" class="form-label">
                                    If you’d like to earn referral rewards (gift cards to Amazon, Starbucks, and more) for sharing with friends, add their email addresses here. 
                                    <span class="btn btn-alt-success btn-sm cursor-pointer add-friends"><i class="fa fa-plus" ></i></span>
                                </label>
                                <div id="friends_holder">
                                    @if(old('friends') && count(old('friends')) > 0)
                                        @foreach(old('friends') as $key => $old)
                                            <div class="mb-2">
                                                <div class="d-flex gap-2">
                                                    @php 
                                                        $error_key = 'friends.' . $key
                                                    @endphp
                                                    <input type="text" name="friends[]" value="{{ $old }}" class="form-control parent-student-email {{$errors->has($error_key) ? 'is-invalid' : 'dsfsf'}}" placeholder="Enter email address">
                                                    <span class="btn btn-alt-danger cursor-pointer remove-friends"><i class="fa fa-minus" ></i></span>
                                                </div>
                                                @if($errors->has($error_key)) 
                                                    <div class="text-danger">{{ $errors->first($error_key) }}</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="mb-2">
                                            <div class="d-flex gap-2">
                                                <input type="text" name="friends[0]" class="form-control friends-emails" placeholder="Enter email address">
                                                <span class="btn btn-alt-danger cursor-pointer remove-friends"><i class="fa fa-minus" ></i></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="reference_path" class="form-label">How did you find College Prep System?</label>
                                <select name="reference_path" id="reference_path" class="form-control {{$errors->has('reference_path') ? 'is-invalid' : ''}}">
                                    <option value="">Select option</option>
                                    @foreach($reference_options as $option)
                                        <option value="{{ $option }}" @selected(old('reference_path') == $option)>{{ $option }}</option>
                                    @endforeach
                                </select>
                                @error('reference_path')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="specific_path" class="form-label">What need specifically brought you to this site?</label>
                                <select name="specific_path" id="specific_path" class="form-control mb-1 {{$errors->has('specific_path') ? 'is-invalid' : ''}}">
                                    <option value="">Select option</option>
                                    @foreach($specific_brought as $option)
                                        <option value="{{ $option }}" @selected(old('specific_path') == $option)>{{ $option }}</option>
                                    @endforeach
                                </select>
                                @error('specific_path')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if(old('specific_path') && old('specific_path') == 'Other')
                                    <div class="mb-3">
                                        <input type="text" name="specific_path_other_detail" id="specific_path_other_detail" class="form-control {{$errors->has('specific_path_other_detail') ? 'is-invalid' : ''}}" placeholder="Enter other detail" value="{{ old('specific_path_other_detail') }}">
                                        @error('specific_path_other_detail')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="found_other_website_link" class="form-label">Have you found other websites that include both college admissions and test preparation in one system? If yes, which sites?  If you haven’t seen one, welcome to possibly the only all-in-one college prep system.</label>
                                <textarea name="found_other_website_link" id="found_other_website_link" cols="30" rows="3" class="form-control {{$errors->has('found_other_website_link') ? 'is-invalid' : ''}}" placeholder="Enter other websites">{{ old('found_other_website_link') ? old('found_other_website_link') : '' }}</textarea>
                                @error('found_other_website_link')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end mb-3">
                                <button type="submit" class="btn btn-alt-success">Submit Survey</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('user-script')
<script src="{{asset('js/survey.js')}}"></script>
@endsection