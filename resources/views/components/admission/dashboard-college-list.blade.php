@if(count($college_list_deadline) > 0)
    <div class="row @if(count($college_list_deadline) > 3) owl-carousel owl-theme @endif">
        @foreach($college_list_deadline as $key => $deadline)
            <div class="@if(count($college_list_deadline) > 3) col-12 @else col-6 col-md-4 @endif">
                <div class="block block-bordered shadow py-3 px-2 gap-1 d-flex flex-column align-items-center @if(!$deadline['college_information']['regular_admission_deadline']) box-height @endif">
                @if($deadline['college_information']['college_icon'])
                    <img class="college-image" src="{{ asset('college_icon/' . $deadline['college_information']['college_icon']) }}" alt="">
                @else
                    <img class="college-image" src="{{ asset('static-image/no-image.jpg') }}" alt="">
                @endif
                <div class="fs-sm fw-semibold text-muted text-uppercase">Choice #{{$key + 1}}</div>
                <a class="text-dark text-center">{{ $deadline['college_name'] }}</a>
                <div class="fs-sm fw-semibold text-muted text-uppercase">Admissions Deadline</div>
                @if($deadline['college_information']['regular_admission_deadline'])
                    <a class="text-dark">{{ $deadline['college_information']['regular_admission_deadline'] }}</a>
                    <a class="text-dark">{{ $deadline['college_deadline']['admissions_deadline_diff'] }}</a>
                @else
                    <span class="text-danger">Not Published</span>
                @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="no-data mb-4">
        <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}" class="btn btn-alt-success btn-sm">Click here to add college</a>
    </div>
@endif