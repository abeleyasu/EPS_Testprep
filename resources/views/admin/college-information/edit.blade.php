@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
  <div class="content">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <a href="{{ route('admin.admission-management.college-information.index') }}" class="btn btn-sm btn-alt-primary me-2" data-bs-toggle="tooltip" title="back">
          <i class="fa fa-fw fa-arrow-left-long"></i>
        </a>
        <h3 class="block-title">Edit College Information : {{ $info->name }}</h3>
      </div>
      <div class="block-content block-content-full">
        <form action="{{ route('admin.admission-management.college-information.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{ $info->id }}">

          <div class="d-flex mb-4">
            <div class="form-group col-md-5">
              <label for="image">Profile Picture:</label>
              <input type="file" class="form-control" id="college_icon" name="college_icon">
              <img id="preview" src="" alt="" style="max-width: 100px; margin-top: 10px;">
            </div>
            <div class="form-group" style="margin-left: 2rem;">
              <img class="profile_pic" id="preview" src="{{ $info->college_icon ? asset('college_icon/' . $info->college_icon) : asset('images/no_image.png') }}" alt="No Image" height="100">
            </div>
          </div>

          <div class="mb-4">
            <label class="from-label">Select Entrance Difficulty:</label>
            <select id="entrance_difficulty" name="entrance_difficulty" class="form-control form-control-lg form-control-alt {{$errors->has('entrance_difficulty') ? 'is-invalid' : ''}}">
              <option value="">Select Entrance Difficulty</option>
              @foreach(config('constants.entrance_difficulty') as $key => $value)
                <option value="{{ $value }}" @if($info->entrance_difficulty && $info->entrance_difficulty == $value) selected @endif >{{ $value }}</option>
              @endforeach
            </select>
            @error('entrance_difficulty')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
          <div class="mb-4">
            <label class="from-label">Average GPA:</label>
            <input type="text" class="js-range-slider {{$errors->has('gpa_average') ? 'is-invalid' : ''}}" name="gpa_average" data-step="0.1" data-min="0.00" data-max="8.00" data-from="{{ $info->gpa_average ? $info->gpa_average : 0.00 }}" data-grid="true"/>
            @error('gpa_average')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Average ACT Composite Score:</label>
            <input type="text" class="js-range-slider {{$errors->has('act_composite_average') ? 'is-invalid' : ''}}" name="act_composite_average" data-type="double" data-min="0" data-max="36" data-from="{{ $info->act_composite_average ? explode('-',$info->act_composite_average)[0] : 0 }}" data-to="{{ $info->act_composite_average ? explode('-',$info->act_composite_average)[1] : 10 }}" data-grid="true"/>
            @error('act_composite_average')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Average Math Score:</label>
            <input type="text" class="js-range-slider {{$errors->has('sat_math_average') ? 'is-invalid' : ''}}" name="sat_math_average" data-type="double" data-min="200" data-max="800" data-from="{{ $info->sat_math_average ? explode('-',$info->sat_math_average)[0] : 200 }}" data-to="{{ $info->sat_math_average ? explode('-',$info->sat_math_average)[1] : 400 }}" data-grid="true"/>
            @error('sat_math_average')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          
          <div class="mb-4">
            <label class="from-label">Average SAT Reading/Writing Score:</label>
            <input type="text" class="js-range-slider {{$errors->has('sat_reading_writing_average') ? 'is-invalid' : ''}}" name="sat_reading_writing_average" data-type="double" data-min="200" data-max="800" data-from="{{ $info->sat_reading_writing_average ? explode('-',$info->sat_reading_writing_average)[0] : 200 }}" data-to="{{ $info->sat_reading_writing_average ? explode('-',$info->sat_reading_writing_average)[1] : 400 }}" data-grid="true"/>
            @error('sat_reading_writing_average')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Average SAT Composite Score:</label>
            <input type="text" class="js-range-slider {{$errors->has('sat_composite_score') ? 'is-invalid' : ''}}" name="sat_composite_score" data-type="double" data-min="400" data-max="1600" data-from="{{ $info->sat_composite_score ? explode('-', $info->sat_composite_score)[0] : 400 }}" data-to="{{ $info->sat_composite_score ? explode('-', $info->sat_composite_score)[1] : 800 }}"  data-grid="true"/>
            @error('sat_composite_score')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Cost of Attendance:</label>
            <input type="text" class="form-control {{$errors->has('cost_of_attendance') ? 'is-invalid' : ''}}" name="cost_of_attendance" value="{{ $errors->has('cost_of_attendance') ? old('cost_of_attendance') :$info->cost_of_attendance }}"/>
            @error('cost_of_attendance')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Tuition and Fees:</label>
            <input type="text" class="form-control {{$errors->has('tution_and_fess') ? 'is-invalid' : ''}}" name="tution_and_fess" value="{{ $errors->has('tution_and_fess') ? old('tution_and_fess') : $info->tution_and_fess }}"/>
            @error('tution_and_fess')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Room and Board:</label>
            <input type="text" class="form-control {{$errors->has('room_and_board') ? 'is-invalid' : ''}}" name="room_and_board" value="{{ $errors->has('room_and_board') ? old('room_and_board')  :  $info->room_and_board }}"/>
            @error('room_and_board')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Average Percent of Need Met:</label>
            <input type="text" class="js-range-slider {{$errors->has('average_percent_of_need_met') ? 'is-invalid' : ''}}" name="average_percent_of_need_met" data-min="0" data-max="100" data-from="{{ $info->average_percent_of_need_met ? $info->average_percent_of_need_met : 0 }}" data-grid="true"/>
            @error('average_percent_of_need_met')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Average Freshman Award:</label>
            <input type="text" class="form-control {{$errors->has('average_freshman_award') ? 'is-invalid' : ''}}" name="average_freshman_award" value="{{ $errors->has('average_freshman_award') ? old('average_freshman_award') : $info->average_freshman_award }}"/>
            @error('average_freshman_award')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4 d-flex gap-3">
            <label class="from-label">Early Action Offered:</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="early_action_offerd1" name="early_action_offerd" value="1" @if($info->early_action_offerd == '1') checked @endif>
              <label class="form-check-label" for="early_action_offerd1">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="early_action_offerd2" name="early_action_offerd" value="0" @if($info->early_action_offerd == '0') checked @endif>
              <label class="form-check-label" for="early_action_offerd2">No</label>
            </div>
            @error('early_action_offerd')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4 d-flex gap-3">
            <label class="from-label">Early Decision Offered:</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="early_decision_offerd1" name="early_decision_offerd" value="1" @if($info->early_decision_offerd == '1') checked @endif>
              <label class="form-check-label" for="early_decision_offerd1">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="early_decision_offerd2" name="early_decision_offerd" value="0" @if($info->early_decision_offerd == '0') checked @endif>
              <label class="form-check-label" for="early_decision_offerd2">No</label>
            </div>
            @error('early_decision_offerd')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Regular Admission Deadline:</label>
            <input type="text" class="date-own form-control {{$errors->has('regular_admission_deadline') ? 'is-invalid' : ''}}" name="regular_admission_deadline" value="{{ $info->regular_admission_deadline }}"/>
            @error('regular_admission_deadline')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="from-label">Description:</label>
            <textarea class="form-control" id="js-ckeditor-desc" name="description" rows="4" placeholder="College Description" autocomplete="__away">
              {{ $info->description }}
            </textarea>
            @error('description')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="row mb-4">
            <div class="col-md-6 col-xl-5">
              <button type="submit" class="btn w-100 btn-alt-success">
                  <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Edit College Information
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<!-- END Main Container -->
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('admin-script')
<script src="{{asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
  $(".js-range-slider").ionRangeSlider({
    skin: 'round',
    values_separator: "-",
    input_values_separator: "-",
  });

  $('.date-own').datepicker({
    format: 'mm-dd-yyyy',
    autoclose: true
  });

  $('#college_icon').on('change', function (e) {
    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
  })
</script>
@endsection
