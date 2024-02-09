@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('admin-content')
    <!-- Main Container -->
    <main id="main-container">
        <div class="content">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <a href="{{ route('admin.admission-management.college-information.index') }}"
                        class="btn btn-sm btn-alt-primary me-2" data-bs-toggle="tooltip" title="back">
                        <i class="fa fa-fw fa-arrow-left-long"></i>
                    </a>
                    <h3 class="block-title">Edit College Information : {{ $info->name }}</h3>
                </div>
                <div class="block-content block-content-full">
                    <form action="{{ route('admin.admission-management.college-information.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $info->id }}">

                        <div class="d-flex mb-4">
                            <div class="form-group col-md-5">
                                <label for="image">Profile Picture:</label>
                                <input type="file" class="form-control" id="college_icon" name="college_icon">
                                <img id="preview" src="" alt=""
                                    style="max-width: 100px; margin-top: 10px;">
                            </div>
                            <div class="form-group" style="margin-left: 2rem;">
                                <img class="profile_pic" id="preview"
                                    src="{{ $info->college_icon ? asset('college_icon/' . $info->college_icon) : asset('images/no_image.png') }}"
                                    alt="No Image" height="100">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="from-label">Select Entrance Difficulty:</label>
                            <select id="entrance_difficulty" name="entrance_difficulty"
                                class="form-control form-control-lg form-control-alt {{ $errors->has('entrance_difficulty') ? 'is-invalid' : '' }}">
                                <option value="">Select Entrance Difficulty</option>
                                @foreach (config('constants.entrance_difficulty') as $key => $value)
                                    <option value="{{ $value }}" @if (
                                        (old('entrance_difficulty') && old('entrance_difficulty') == $value) ||
                                            ($info->entrance_difficulty && $info->entrance_difficulty == $value)) selected @endif>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                            @error('entrance_difficulty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="from-label">Average GPA:</label>
                            <input type="text"
                                class="js-range-slider {{ $errors->has('gpa_average') ? 'is-invalid' : '' }}"
                                name="gpa_average" data-step="0.1" data-min="0.00" data-max="8.00"
                                data-from="{{ $info->gpa_average ? $info->gpa_average : 0.0 }}" data-grid="true" />
                            @error('gpa_average')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="from-label">
                                <input {{ $info->display_peterson_weighted_gpa ? 'checked' : '' }} type="checkbox"
                                    class="form-check-input {{ $errors->has('display_peterson_weighted_gpa') ? 'is-invalid' : '' }}"
                                    name="display_peterson_weighted_gpa"
                                    {{ old('display_peterson_weighted_gpa') ? 'checked' : ($info->display_peterson_weighted_gpa ? 'checked' : '') }}>
                                Display Peterson (CSV Data) Weighted GPA
                            </label>

                            @error('display_peterson_weighted_gpa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="from-label">Weighted GPA:</label>
                            <input type="text"
                                class="js-range-slider {{ $errors->has('weighted_gpa') ? 'is-invalid' : '' }}"
                                name="weighted_gpa" data-step="0.1" data-min="0.00" data-max="8.00"
                                data-from="{{ $info->weighted_gpa ? $info->weighted_gpa : 0.0 }}" data-grid="true" />
                            @error('weighted_gpa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="from-label">
                                <input {{ $info->display_peterson_unweighted_gpa ? 'checked' : '' }} type="checkbox"
                                    class="form-check-input {{ $errors->has('display_peterson_unweighted_gpa') ? 'is-invalid' : '' }}"
                                    name="display_peterson_unweighted_gpa"
                                    {{ old('display_peterson_unweighted_gpa') ? 'checked' : ($info->display_peterson_unweighted_gpa ? 'checked' : '') }}">
                                Display Peterson (CSV Data) UnWeighted GPA
                            </label>

                            @error('display_peterson_weighted_gpa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="from-label">Unweighted GPA:</label>
                            <input type="text"
                                class="js-range-slider {{ $errors->has('unweighted_gpa') ? 'is-invalid' : '' }}"
                                name="unweighted_gpa" data-step="0.1" data-min="0.00" data-max="8.00"
                                data-from="{{ $info->unweighted_gpa ? $info->unweighted_gpa : 0.0 }}" data-grid="true" />
                            @error('unweighted_gpa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label class="from-label">Average ACT Composite Score:</label>
                            <input type="text"
                                class="js-range-slider {{ $errors->has('act_composite_average') ? 'is-invalid' : '' }}"
                                name="act_composite_average" data-type="double" data-min="0" data-max="36"
                                data-from="{{ $info->act_composite_average ? explode('-', $info->act_composite_average)[0] : 0 }}"
                                data-to="{{ $info->act_composite_average ? explode('-', $info->act_composite_average)[1] : 10 }}"
                                data-grid="true" />
                            @error('act_composite_average')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="from-label">Average Math Score:</label>
                            <input type="text"
                                class="js-range-slider {{ $errors->has('sat_math_average') ? 'is-invalid' : '' }}"
                                name="sat_math_average" data-type="double" data-min="200" data-max="800"
                                data-from="{{ $info->sat_math_average ? explode('-', $info->sat_math_average)[0] : 200 }}"
                                data-to="{{ $info->sat_math_average ? explode('-', $info->sat_math_average)[1] : 400 }}"
                                data-grid="true" />
                            @error('sat_math_average')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label class="from-label">Average SAT Reading/Writing Score:</label>
                            <input type="text"
                                class="js-range-slider {{ $errors->has('sat_reading_writing_average') ? 'is-invalid' : '' }}"
                                name="sat_reading_writing_average" data-type="double" data-min="200" data-max="800"
                                data-from="{{ $info->sat_reading_writing_average ? explode('-', $info->sat_reading_writing_average)[0] : 200 }}"
                                data-to="{{ $info->sat_reading_writing_average ? explode('-', $info->sat_reading_writing_average)[1] : 400 }}"
                                data-grid="true" />
                            @error('sat_reading_writing_average')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="from-label">Average SAT Composite Score:</label>
                            <input type="text"
                                class="js-range-slider {{ $errors->has('sat_composite_score') ? 'is-invalid' : '' }}"
                                name="sat_composite_score" data-type="double" data-min="400" data-max="1600"
                                data-from="{{ $info->sat_composite_score ? explode('-', $info->sat_composite_score)[0] : 400 }}"
                                data-to="{{ $info->sat_composite_score ? explode('-', $info->sat_composite_score)[1] : 800 }}"
                                data-grid="true" />
                            @error('sat_composite_score')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($info->ownership == '2')
                            <div class="form-check form-switch">
                                <input name="display_peterson_pvt_coa"
                                    id="display_peterson_pvt_coa"
                                    {{ $info->display_peterson_pvt_coa ? 'checked' : '' }} class="form-check-input"
                                    type="checkbox" role="switch" id="display_peterson_pvt_coa_switch"
                                    {{ old('display_peterson_pvt_coa') ? 'checked' : ($info->display_peterson_pvt_coa ? 'checked' : '') }}
                                    >
                                <label class="form-check-label" for="flexSwitchCheckDefault">Display Peterson Cost of
                                    Attendance</label>
                                @error('display_peterson_pvt_coa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="row">
                                <div {{ $info->display_peterson_pvt_coa == "0" ? 'hidden' : ''}} id="pvt_coa_container" class="mb-4 col">
                                    <label class="from-label">Cost of Attendance:</label>
                                    <small>Peterson Data</small>
                                    <input disabled type="text"
                                        class="form-control {{ $errors->has('pvt_coa') ? 'is-invalid' : '' }}"
                                        name="pvt_coa" value="{{ old('pvt_coa') ? old('pvt_coa') : $info->pvt_coa }}" />
                                    @error('pvt_coa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div {{ $info->display_peterson_pvt_coa == "1" ? 'hidden' : '' }} id="pvt_coa_container_admin" class="mb-4 col">
                                    <label class="from-label">Cost of Attendance:</label>
                                    <small>Custom Cost Of Attendance</small>
                                    <input type="text"
                                        class="form-control {{ $errors->has('pvt_coa_admin') ? 'is-invalid' : '' }}"
                                        name="pvt_coa_admin"
                                        value="{{ old('pvt_coa_admin') ? old('pvt_coa_admin') : $info->pvt_coa_admin }}" />
                                    @error('pvt_coa_admin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <div class="mb-4 display_peterson_public_coa_container">

                              <div class="form-check form-switch">
                                  <input name="display_peterson_public_coa"
                                      id="display_peterson_public_coa"
                                      {{ $info->display_peterson_public_coa ? 'checked' : '' }} class="form-check-input"
                                      type="checkbox" role="switch" id="display_peterson_public_coa_switch"
                                      {{ old('display_peterson_public_coa') ? 'checked' : ($info->display_peterson_public_coa ? 'checked' : '') }}
                                      >
                                  <label class="form-check-label" for="flexSwitchCheckDefault">Display Peterson Cost of
                                      Attendance (Public) </label>
                                  @error('display_peterson_public_coa')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col public_coa_container"
                                {{ $info->display_peterson_public_coa == 1 ? '' : 'hidden'}}
                                >
                                    <label class="from-label">Cost of Attendance (In State):</label>
                                    <input disabled type="text"
                                        class="form-control {{ $errors->has('public_coa_in_state') ? 'is-invalid' : '' }}"
                                        name="public_coa_in_state"
                                        value="{{ old('public_coa_in_state') ? old('public_coa_in_state') : $info->public_coa_in_state }}" />
                                    @error('public_coa_in_state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4 col public_coa_container_admin"
                                {{ $info->display_peterson_public_coa == 0 ? '' : 'hidden'}}
                                >
                                    <label class="from-label">Cost of Attendance (In State):</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('public_coa_in_state_admin') ? 'is-invalid' : '' }}"
                                        name="public_coa_in_state_admin"
                                        value="{{ old('public_coa_in_state_admin') ? old('public_coa_in_state_admin') : $info->public_coa_in_state_admin }}" />
                                    @error('public_coa_in_state_admin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div
                                {{ $info->display_peterson_public_coa == 1 ? '' : 'hidden'}}
                                
                                class="mb-4 col public_coa_container">
                                    <label class="from-label">Cost of Attendance (Out of State):</label>
                                    <input disabled type="text"
                                        class="form-control {{ $errors->has('public_coa_out_state') ? 'is-invalid' : '' }}"
                                        name="public_coa_out_state"
                                        value="{{ old('public_coa_out_state') ? old('public_coa_out_state') : $info->public_coa_out_state }}" />
                                    @error('public_coa_in_state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4 col public_coa_container_admin"
                                {{ $info->display_peterson_public_coa == 0 ? '' : 'hidden'}}
                                
                                >
                                    <label class="from-label">Cost of Attendance (Out of State):</label>
                                    <small>Admin Data</small>
                                    <input type="text"
                                        class="form-control {{ $errors->has('public_coa_out_state_admin') ? 'is-invalid' : '' }}"
                                        name="public_coa_out_state_admin"
                                        value="{{ old('public_coa_out_state_admin') ? old('public_coa_out_state_admin') : $info->public_coa_out_state_admin }}" />
                                    @error('public_coa_in_state_admin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label class="from-label">Tuition and Fees:</label>
                            <input type="text"
                                class="form-control {{ $errors->has('tution_and_fess') ? 'is-invalid' : '' }}"
                                name="tution_and_fess"
                                value="{{ old('tution_and_fess') ? old('tution_and_fess') : $info->tution_and_fess }}" />
                            @error('tution_and_fess')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="from-label">Room and Board:</label>
                            <input type="text"
                                class="form-control {{ $errors->has('room_and_board') ? 'is-invalid' : '' }}"
                                name="room_and_board"
                                value="{{ old('room_and_board') ? old('room_and_board') : $info->room_and_board }}" />
                            @error('room_and_board')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="from-label">Average Percent of Need Met:</label>
                            <input type="text"
                                class="js-range-slider {{ $errors->has('average_percent_of_need_met') ? 'is-invalid' : '' }}"
                                name="average_percent_of_need_met" data-min="0" data-max="100"
                                data-from="{{ $info->average_percent_of_need_met ? $info->average_percent_of_need_met : 0 }}"
                                data-grid="true" />
                            @error('average_percent_of_need_met')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="from-label">Average Freshman Award:</label>
                            <input type="text"
                                class="form-control {{ $errors->has('average_freshman_award') ? 'is-invalid' : '' }}"
                                name="average_freshman_award"
                                value="{{ old('average_freshman_award') ? old('average_freshman_award') : $info->average_freshman_award }}" />
                            @error('average_freshman_award')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mb-4 d-flex gap-3">
            <label class="from-label">Early Action Offered:</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="early_action_offerd1" name="early_action_offerd" value="1" @if ($info->early_action_offerd == '1') checked @endif>
              <label class="form-check-label" for="early_action_offerd1">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="early_action_offerd2" name="early_action_offerd" value="0" @if ($info->early_action_offerd == '0') checked @endif>
              <label class="form-check-label" for="early_action_offerd2">No</label>
            </div>
            @error('early_action_offerd')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div> --}}

                        {{-- <div class="mb-4 d-flex gap-3">
            <label class="from-label">Early Decision Offered:</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="early_decision_offerd1" name="early_decision_offerd" value="1" @if ($info->early_decision_offerd == '1') checked @endif>
              <label class="form-check-label" for="early_decision_offerd1">Yes</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="early_decision_offerd2" name="early_decision_offerd" value="0" @if ($info->early_decision_offerd == '0') checked @endif>
              <label class="form-check-label" for="early_decision_offerd2">No</label>
            </div>
            @error('early_decision_offerd')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div> --}}

                        {{-- <div class="mb-4">
            <label class="from-label">Regular Admission Deadline:</label>
            <input type="text" class="date-own form-control {{$errors->has('regular_admission_deadline') ? 'is-invalid' : ''}}" name="regular_admission_deadline" value="{{ old('regular_admission_deadline') ? old('regular_admission_deadline') : $info->regular_admission_deadline }}"/>
            @error('regular_admission_deadline')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div> --}}

                        <div class="mb-4">
                            <label class="from-label">Rolling Admission Deadline:</label>
                            <input type="text"
                                class="date-own form-control {{ $errors->has('rolling_admission_deadline') ? 'is-invalid' : '' }}"
                                name="rolling_admission_deadline"
                                value="{{ old('rolling_admission_deadline') ? old('rolling_admission_deadline') : $info->rolling_admission_deadline }}" />
                            @error('rolling_admission_deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        @foreach($date_inputs as $date_key => $date_value)
                            <div class="form-check form-switch">
                                <input name="display_peterson_{{$date_key}}"
                                    id="display_peterson_{{$date_key}}"
                                    {{ $info['display_peterson_' . $date_key] ? 'checked' : '' }} class="form-check-input"
                                    type="checkbox" role="switch" id="display_peterson_{{$date_key}}"
                                    {{ old('display_peterson_' . $date_key) ? 'checked' : ($info['display_peterson_' . $date_key] ? 'checked' : '') }}
                                    >
                                <label class="form-check-label" for="flexSwitchCheckDefault">Display Peterson {{$date_value}} </label>
                                @error('display_peterson_' . $date_key)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="from-label">{{ $date_value }}:</label>
                                <input type="text"
                                    class="date-own form-control {{ $errors->has('$date_key') ? 'is-invalid' : '' }}"
                                    name="{{$date_key}}"
                                    value="{{ old('$date_key') ? old('$date_key') : $info->$date_key }}" />
                                @error('{{$date_key}}')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        @endforeach

                        <div class="mb-4">
                            <label class="from-label">Early Action Deadline (M/D/YY):</label>
                            <input type="text"
                                disabled 
                                class="date-own form-control"
                                value="{{ new Date $info->AP_DL_EACT_MON . "-" . $info->AP_DL_EACT_DAY  . "-"}}" />
                        </div>




                        <div class="mb-4">
                            <label class="from-label">Early Action Deadline:</label>
                            <input type="text"
                                class="date-own form-control {{ $errors->has('early_action_deadline') ? 'is-invalid' : '' }}"
                                name="early_action_deadline"
                                value="{{ old('rolling_admission_deadline') ? old('rolling_admission_deadline') : $info->rolling_admission_deadline }}" />
                            @error('rolling_admission_deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="from-label">Website URL:</label>
                            <input type="text"
                                class="form-control {{ $errors->has('school_url') ? 'is-invalid' : '' }}"
                                name="school_url"
                                value="{{ old('school_url') ? old('school_url') : $info->school_url }}" />
                            @error('school_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="from-label">Description:</label>
                            <textarea class="form-control" id="js-ckeditor-desc" name="description" rows="4"
                                placeholder="College Description" autocomplete="__away">
              {{ old('description') ? old('description') : $info->description }}
            </textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
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
    <script src="{{ asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
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

        $('#college_icon').on('change', function(e) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        })

        /**
         * Toggles between displaying data for the admin and Peterson based on the state of a checkbox.
         * Hello 
         * @param {string} checkboxSelector - The CSS selector for the checkbox element.
         * @param {string[]} selectorsOfElToHide - An array of CSS selectors for elements to hide when the checkbox is checked.
         * @param {string[]} selectorsOfElToShow - An array of CSS selectors for elements to show when the checkbox is checked.
        */
        function toggleBetweenAdminAndPetersonData(checkboxSelector, selectorsOfElToHide, selectorsOfElToShow){
            $(checkboxSelector).change(function(){
                if(this.checked){
                    selectorsOfElToHide.forEach(element => $(element).prop('hidden', true) )
                    selectorsOfElToShow.forEach(element => $(element).removeAttr('hidden') )
                }else{
                    selectorsOfElToShow.forEach(element => $(element).prop('hidden', true) )
                    selectorsOfElToHide.forEach(element => $(element).removeAttr('hidden') )
                }
            })

        }
        toggleBetweenAdminAndPetersonData('#display_peterson_public_coa',['.public_coa_container_admin'] , ['.public_coa_container'])
        toggleBetweenAdminAndPetersonData('#display_peterson_pvt_coa',['.pvt_coa_container_admin'] , ['.pvt_coa_container'])
    </script>
@endsection
