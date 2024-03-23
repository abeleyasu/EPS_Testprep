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
                        <input data-id="{{ $info->college_id }}" type="hidden" name="id" value="{{ $info->id }}">

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

                        <div id="admission-cost">
                            @if ($info->ownership == '1')
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="row">
                                            <div class="col-8">
                                                <label class="from-label">Cost of Attendance (In State):</label>
                                                <input type="number"
                                                    class="form-control {{ $errors->has('public_coa_in_state') ? 'is-invalid' : '' }}"
                                                    name="public_coa_in_state"
                                                    value="{{ old('public_coa_in_state') ? old('public_coa_in_state') : $info->public_coa_in_state }}"
                                                    v-model="public_coa_in_state" />
                                                @error('public_coa_in_state')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-1">&nbsp;</div>
                                                <div class="btn-group reset-button">
                                                    <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Reset
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        {{-- <li><a class="dropdown-item" href="#">from Score Card API </a></li> --}}
                                                        <li><a class="dropdown-item" href="#"
                                                                @click.prevent="resetFromPetersonData('public_coa_in_state')">from
                                                                Peterson CSV</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="row">
                                            <div class="col-8">
                                                <label class="from-label">Cost of Attendance (Out of State):</label>
                                                <input type="number"
                                                    class="form-control {{ $errors->has('public_coa_out_state') ? 'is-invalid' : '' }}"
                                                    name="public_coa_out_state"
                                                    value="{{ old('public_coa_out_state') ? old('public_coa_out_state') : $info->public_coa_out_state }}"
                                                    v-model="public_coa_out_state" />
                                                @error('public_coa_out_state')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-1">&nbsp;</div>
                                                <div class="btn-group reset-button">
                                                    <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Reset
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        {{-- <li><a class="dropdown-item" href="#">from Score Card API </a></li> --}}
                                                        <li><a class="dropdown-item" href="#"
                                                                @click.prevent="resetFromPetersonData('public_coa_out_state')">from
                                                                Peterson CSV</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6 mb-4 col pvt_coa_container">
                                        <label class="from-label">Cost of Attendance:</label>
                                        <input type="number"
                                            class="form-control {{ $errors->has('pvt_coa') ? 'is-invalid' : '' }}"
                                            name="pvt_coa" value="{{ old('pvt_coa') ? old('pvt_coa') : $info->pvt_coa }}"
                                            v-model="pvt_coa" />
                                        @error('pvt_coa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-1">&nbsp;</div>
                                        <div class="btn-group reset-button">
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Reset
                                            </button>
                                            <ul class="dropdown-menu">
                                                {{-- <li><a class="dropdown-item" href="#">from Score Card API </a></li> --}}
                                                <li><a class="dropdown-item" href="#"
                                                        @click.prevent="resetFromPetersonData('pvt_coa')">from
                                                        Peterson CSV</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($info->ownership == '1')
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="row">
                                            <div class="col-8">
                                                <label class="from-label">Tuition and Fees (In-State):</label>
                                                <input type="number"
                                                    class="form-control {{ $errors->has('tuition_and_fee_instate') ? 'is-invalid' : '' }}"
                                                    name="tuition_and_fee_instate"
                                                    value="{{ old('tuition_and_fee_instate') ? old('tuition_and_fee_instate') : $info->tuition_and_fee_instate }}"
                                                    v-model="tuition_and_fee_instate" />
                                                @error('tuition_and_fee_instate')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-1">&nbsp;</div>
                                                <div class="btn-group reset-button">
                                                    <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Reset
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#"
                                                                @click.prevent="resetFromScorecardData('tuition_and_fee_instate')">from
                                                                Score Card API </a></li>
                                                        <li><a class="dropdown-item" href="#"
                                                                @click.prevent="resetFromPetersonData('tuition_and_fee_instate')">from
                                                                Peterson CSV</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="row">
                                            <div class="col-8">
                                                <label class="from-label">Tuition and Fees (Out-of-State):</label>
                                                <input type="number"
                                                    class="form-control {{ $errors->has('tuition_and_fee_outstate') ? 'is-invalid' : '' }}"
                                                    name="tuition_and_fee_outstate"
                                                    value="{{ old('tuition_and_fee_outstate') ? old('tuition_and_fee_outstate') : $info->tuition_and_fee_outstate }}" v-model="tuition_and_fee_outstate" />
                                                @error('tuition_and_fee_outstate')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-1">&nbsp;</div>
                                                <div class="btn-group reset-button">
                                                    <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Reset
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#"
                                                                @click.prevent="resetFromScorecardData('tuition_and_fee_outstate')">from
                                                                Score Card API </a></li>
                                                        <li><a class="dropdown-item" href="#"
                                                                @click.prevent="resetFromPetersonData('tuition_and_fee_outstate')">from
                                                                Peterson CSV</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="from-label">Tuition and Fees:</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('tution_and_fess') ? 'is-invalid' : '' }}"
                                            name="tution_and_fess"
                                            value="{{ old('tution_and_fess') ? old('tution_and_fess') : $info->tution_and_fess }}" />
                                        @error('tution_and_fess')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
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

                        {{-- <div class="mb-4">
                            <label class="from-label">Rolling Admission Deadline:</label>
                            <input type="text"
                                class="date-own form-control {{ $errors->has('rolling_admission_deadline') ? 'is-invalid' : '' }}"
                                name="rolling_admission_deadline"
                                value="{{ old('rolling_admission_deadline') ? old('rolling_admission_deadline') : $info->rolling_admission_deadline }}" />
                            @error('rolling_admission_deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}


                        {{-- @foreach ($date_inputs as $date_key => $date_value)
                            <div class="form-check form-switch">
                                <input name="display_peterson_{{ $date_key }}"
                                    id="display_peterson_{{ $date_key }}"
                                    {{ $info['display_peterson_' . $date_key] ? 'checked' : '' }} class="form-check-input"
                                    type="checkbox" role="switch" id="display_peterson_{{ $date_key }}"
                                    {{ old('display_peterson_' . $date_key) ? 'checked' : ($info['display_peterson_' . $date_key] ? 'checked' : '') }}>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Display Peterson
                                    {{ $date_value }} </label>
                                @error('display_peterson_' . $date_key)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="from-label">{{ $date_value }}:</label>
                                <input type="text"
                                    class="date-own form-control {{ $errors->has('$date_key') ? 'is-invalid' : '' }}"
                                    name="{{ $date_key }}"
                                    value="{{ old('$date_key') ? old('$date_key') : $info->$date_key }}" />
                                @error('{{ $date_key }}')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach --}}


                        {{-- <div class="mb-4">
                            <label class="from-label">Early Action Deadline (M/D/YY):</label>
                            <input type="text" disabled class="date-own form-control"
                                value="{{ $info->AP_DL_EACT_MON . '-' . $info->AP_DL_EACT_DAY . '-' . '2024' }}" />
                        </div> --}}



                        {{-- <div class="">
                            <label class="from-label">Early Action Deadline:</label>
                            <input type="text"
                                class="date-own form-control {{ $errors->has('early_action_deadline') ? 'is-invalid' : '' }}"
                                name="early_action_deadline"
                                value="{{ old('rolling_admission_deadline') ? old('rolling_admission_deadline') : $info->rolling_admission_deadline }}" />
                            @error('rolling_admission_deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        {{-- <div class="col d-flex align-items-end">
                            <button class="btn btn-primary">Reset</button>
                        </div> --}}


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
                        <div class="mb-4">
                            <label class="form-label">Has National Fraternities:</label>
                            <select class="form-select" name="has_national_fraternities">
                                <option value="1"
                                    {{ old('has_national_fraternities', $info->has_national_fraternities) ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0"
                                    {{ !old('has_national_fraternities', $info->has_national_fraternities) ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Has Local Fraternities:</label>
                            <select class="form-select" name="has_local_fraternities">
                                <option value="1"
                                    {{ old('has_local_fraternities', $info->has_local_fraternities) ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0"
                                    {{ !old('has_local_fraternities', $info->has_local_fraternities) ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Percent of Freshmen Joining Fraternities:</label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control"
                                name="percent_freshmen_join_fraternities"
                                value="{{ old('percent_freshmen_join_fraternities', $info->percent_freshmen_join_fraternities) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Percent of Men Joining Fraternities:</label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control"
                                name="percent_men_join_fraternities"
                                value="{{ old('percent_men_join_fraternities', $info->percent_men_join_fraternities) }}" />
                        </div>

                        <!-- Sorority-related fields -->
                        <div class="mb-4">
                            <label class="form-label">Academic Calendar System:</label>
                            <input type="text" class="form-control" name="academic_calendar_system"
                                value="{{ old('academic_calendar_system', $info->academic_calendar_system) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Percent of Women Joining Sororities:</label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control"
                                name="percent_women_join_sororities"
                                value="{{ old('percent_women_join_sororities', $info->percent_women_join_sororities) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Percent of Freshmen Joining Sororities:</label>
                            <input type="number" step="0.01" min="0" max="100" class="form-control"
                                name="percent_freshmen_join_sororities"
                                value="{{ old('percent_freshmen_join_sororities', $info->percent_freshmen_join_sororities) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Has Local Sororities:</label>
                            <select class="form-select" name="has_local_sororities">
                                <option value="1"
                                    {{ old('has_local_sororities', $info->has_local_sororities) ? 'selected' : '' }}>Yes
                                </option>
                                <option value="0"
                                    {{ !old('has_local_sororities', $info->has_local_sororities) ? 'selected' : '' }}>No
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Has National Sororities:</label>
                            <select class="form-select" name="has_national_sororities">
                                <option value="1"
                                    {{ old('has_national_sororities', $info->has_national_sororities) ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0"
                                    {{ !old('has_national_sororities', $info->has_national_sororities) ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>

                        <!-- Athletics-related fields -->
                        <div class="mb-4">
                            <label class="form-label">NCAA:</label>
                            <select class="form-select" name="ncaa">
                                <option value="1" {{ old('ncaa', $info->ncaa) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !old('ncaa', $info->ncaa) ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">NAIA:</label>
                            <select class="form-select" name="naia">
                                <option value="1" {{ old('naia', $info->naia) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !old('naia', $info->naia) ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">NCCAA:</label>
                            <select class="form-select" name="nccaa">
                                <option value="1" {{ old('nccaa', $info->nccaa) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !old('nccaa', $info->nccaa) ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">NJCAA:</label>
                            <select class="form-select" name="njcaa">
                                <option value="1" {{ old('njcaa', $info->njcaa) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !old('njcaa', $info->njcaa) ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <!-- Housing and Location fields -->
                        <div class="mb-4">
                            <label class="form-label">Number of Students in College Housing:</label>
                            <input type="number" class="form-control" name="num_students_in_housing"
                                value="{{ old('num_students_in_housing', $info->num_students_in_housing) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Freshman Housing Guarantee:</label>
                            <select class="form-select" name="freshman_housing_guarantee">
                                <option value="1"
                                    {{ old('freshman_housing_guarantee', $info->freshman_housing_guarantee) ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0"
                                    {{ !old('freshman_housing_guarantee', $info->freshman_housing_guarantee) ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Nearest Metropolitan Area:</label>
                            <input type="text" class="form-control" name="nearest_metropolitan_area"
                                value="{{ old('nearest_metropolitan_area', $info->nearest_metropolitan_area) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">City Population:</label>
                            <input type="number" class="form-control" name="city_population"
                                value="{{ old('city_population', $info->city_population) }}" />
                        </div>

                        <!-- Admission and GPA fields -->
                        <div class="mb-4">
                            <label class="form-label">Entrance Difficulty Out of State:</label>
                            <input type="text" class="form-control" name="entrance_difficulty_out_of_state"
                                value="{{ old('entrance_difficulty_out_of_state', $info->entrance_difficulty_out_of_state) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Entrance Difficulty Overall:</label>
                            <input type="text" class="form-control" name="entrance_difficulty_overall"
                                value="{{ old('entrance_difficulty_overall', $info->entrance_difficulty_overall) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Average Weighted GPA:</label>
                            <input type="number" step="0.01" class="form-control" name="average_weighted_gpa"
                                value="{{ old('average_weighted_gpa', $info->average_weighted_gpa) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Average Unweighted GPA:</label>
                            <input type="number" step="0.01" class="form-control" name="average_unweighted_gpa"
                                value="{{ old('average_unweighted_gpa', $info->average_unweighted_gpa) }}" />
                        </div>

                        <!-- Financial aid and Scholarship deadlines -->
                        <div class="mb-4">
                            <label class="form-label">CSS Profile Deadline:</label>
                            <input type="text" class="form-control" name="css_profile_deadline"
                                value="{{ old('css_profile_deadline', $info->css_profile_deadline) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">FAFSA Deadline:</label>
                            <input type="text" class="form-control" name="fafsa_deadline"
                                value="{{ old('fafsa_deadline', $info->fafsa_deadline) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Competitive Scholarship Deadline:</label>
                            <input type="text" class="form-control" name="competitive_scholarship_deadline"
                                value="{{ old('competitive_scholarship_deadline', $info->competitive_scholarship_deadline) }}" />
                        </div>

                        <!-- Admission deadlines -->

                        <div id="admission-deadline">
                            <div class="row align-items-start">
                                <div class="col-md-12">
                                    <label class="form-label">Rolling Admission</label>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label">Month:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('rolling_admission_month') ? 'is-invalid' : '' }}"
                                        name="rolling_admission_month" v-model="rolling_admission_month" />
                                    @error('rolling_admission_month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label">Day:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('rolling_admission_day') ? 'is-invalid' : '' }}"
                                        name="rolling_admission_day" v-model="rolling_admission_day" />
                                    @error('rolling_admission_day')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-4">
                                    <div class="mb-1">&nbsp;</div>
                                    {{-- <button class="btn btn-primary">Reset</button> --}}
                                    <div class="btn-group reset-button">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Reset
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- <li><a class="dropdown-item" href="#" @click="resetFromScorecardData('rolling_admission')">from Score Card API </a></li> --}}
                                            <li><a class="dropdown-item" href="#"
                                                    @click.prevent="resetFromPetersonData('rolling_admission')">from
                                                    Peterson CSV</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-start">
                                <div class="col-md-12">
                                    <label class="form-label">Regular Decision</label>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label small">Month:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('regular_decision_month') ? 'is-invalid' : '' }}"
                                        name="regular_decision_month"
                                        value="{{ old('regular_decision_month', $info->regular_decision_month) }}"
                                        v-model="regular_decision_month" />
                                    @error('regular_decision_month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label small">Day:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('regular_decision_day') ? 'is-invalid' : '' }}"
                                        name="regular_decision_day"
                                        value="{{ old('regular_decision_day', $info->regular_decision_day) }}"
                                        v-model="regular_decision_day" />
                                    @error('regular_decision_day')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-4">
                                    <div class="mb-1">&nbsp;</div>
                                    <div class="btn-group reset-button">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Reset
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- <li><a class="dropdown-item" href="#">from Score Card API </a></li> --}}
                                            <li><a class="dropdown-item" href="#"
                                                    @click.prevent="resetFromPetersonData('regular_decision')">from
                                                    Peterson CSV</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-start">
                                <div class="col-md-12">
                                    <label class="form-label">Early Decision II</label>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label small">Month:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('early_decision_ii_month') ? 'is-invalid' : '' }}"
                                        name="early_decision_ii_month"
                                        value="{{ old('early_decision_ii_month', $info->early_decision_ii_month) }}"
                                        v-model="early_decision_ii_month" />
                                    @error('early_decision_ii_month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label small">Day:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('early_decision_ii_day') ? 'is-invalid' : '' }}"
                                        name="early_decision_ii_day"
                                        value="{{ old('early_decision_ii_day', $info->early_decision_ii_day) }}"
                                        v-model="early_decision_ii_day" />
                                    @error('early_decision_ii_day')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-4">
                                    <div class="mb-1">&nbsp;</div>
                                    <div class="btn-group reset-button">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Reset
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- <li><a class="dropdown-item" href="#">from Score Card API </a></li> --}}
                                            <li><a class="dropdown-item" href="#"
                                                    @click.prevent="resetFromPetersonData('early_decision_ii')">from
                                                    Peterson CSV</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-start">
                                <div class="col-md-12">
                                    <label class="form-label">Early Decision I</label>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label small">Month:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('early_decision_i_month') ? 'is-invalid' : '' }}"
                                        name="early_decision_i_month"
                                        value="{{ old('early_decision_i_month', $info->early_decision_i_month) }}"
                                        v-model="early_decision_i_month" />
                                    @error('early_decision_i_month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label small">Day:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('early_decision_i_day') ? 'is-invalid' : '' }}"
                                        name="early_decision_i_day"
                                        value="{{ old('early_decision_i_day', $info->early_decision_i_day) }}"
                                        v-model="early_decision_i_day" />
                                    @error('early_decision_i_day')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-4">
                                    <div class="mb-1">&nbsp;</div>
                                    <div class="btn-group reset-button">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Reset
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- <li><a class="dropdown-item" href="#">from Score Card API </a></li> --}}
                                            <li><a class="dropdown-item" href="#"
                                                    @click.prevent="resetFromPetersonData('early_decision_i')">from
                                                    Peterson CSV</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-start">
                                <div class="col-md-12">
                                    <label class="form-label">Early Action</label>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label small">Month:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('early_action_month') ? 'is-invalid' : '' }}"
                                        name="early_action_month"
                                        value="{{ old('early_action_month', $info->early_action_month) }}"
                                        v-model="early_action_month" />
                                    @error('early_action_month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label class="form-label small">Day:</label>
                                    <input type="number"
                                        class="form-control {{ $errors->has('early_action_day') ? 'is-invalid' : '' }}"
                                        name="early_action_day"
                                        value="{{ old('early_action_day', $info->early_action_day) }}"
                                        v-model="early_action_day" />
                                    @error('early_action_day')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-4">
                                    <div class="mb-1">&nbsp;</div>
                                    <div class="btn-group reset-button">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Reset
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- <li><a class="dropdown-item" href="#">from Score Card API </a></li> --}}
                                            <li><a class="dropdown-item" href="#"
                                                    @click.prevent="resetFromPetersonData('early_action')">from Peterson
                                                    CSV</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Admission statistics -->
                        <div class="mb-4">
                            <label class="form-label">Number of Applications:</label>
                            <input type="number" class="form-control" name="num_applications"
                                value="{{ old('num_applications', $info->num_applications) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Overall Admission Rate:</label>
                            <input type="number" step="0.01" class="form-control" name="overall_admission_rate"
                                value="{{ old('overall_admission_rate', $info->overall_admission_rate) }}" />
                        </div>



                        <div class="mb-4">
                            <label class="form-label">Room & Board:</label>
                            <input type="text" class="form-control" name="room_and_board"
                                value="{{ old('room_and_board', $info->room_and_board) }}" />
                        </div>

                        {{-- Application Types --}}
                        <div class="mb-4">
                            <div class="mb-2">
                                <label class="form-label">Type of Application:</label>
                            </div>

                            <label class="from-label">
                                <input {{ $info->common_app ? 'checked' : '' }} type="checkbox"
                                    class="form-check-input {{ $errors->has('common_app') ? 'is-invalid' : '' }}"
                                    name="common_app"
                                    {{ old('common_app') ? 'checked' : ($info->common_app ? 'checked' : '') }}>
                                Common App
                            </label>

                            @error('common_app')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="from-label">
                                <input {{ $info->coalition_app ? 'checked' : '' }} type="checkbox"
                                    class="form-check-input {{ $errors->has('coalition_app') ? 'is-invalid' : '' }}"
                                    name="coalition_app"
                                    {{ old('coalition_app') ? 'checked' : ($info->coalition_app ? 'checked' : '') }}>
                                Coalition App
                            </label>

                            @error('coalition_app')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="from-label">
                                <input {{ $info->universal_app ? 'checked' : '' }} type="checkbox"
                                    class="form-check-input {{ $errors->has('universal_app') ? 'is-invalid' : '' }}"
                                    name="universal_app"
                                    {{ old('universal_app') ? 'checked' : ($info->universal_app ? 'checked' : '') }}>
                                Universal App
                            </label>

                            @error('universal_app')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="from-label">
                                <input {{ $info->college_system_app ? 'checked' : '' }} type="checkbox"
                                    class="form-check-input {{ $errors->has('college_system_app') ? 'is-invalid' : '' }}"
                                    name="college_system_app"
                                    {{ old('college_system_app') ? 'checked' : ($info->college_system_app ? 'checked' : '') }}>
                                College System App
                            </label>

                            @error('college_system_app')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="from-label">
                                <input {{ $info->apply_directly ? 'checked' : '' }} type="checkbox"
                                    class="form-check-input {{ $errors->has('apply_directly') ? 'is-invalid' : '' }}"
                                    name="apply_directly"
                                    {{ old('apply_directly') ? 'checked' : ($info->apply_directly ? 'checked' : '') }}>
                                Apply Directly
                            </label>

                            @error('apply_directly')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-4">
                            <label class="from-label">Field of Studies:</label>
                            <div>
                                @foreach ($programs_api_data as $program)
                                    <input type="number" hidden class="form-control" value="{{ $program['code'] }}" />

                                    <input type="text" hidden class="form-control"
                                        value="{{ $program['title'] }}" />
                                    <input type="text" hidden class="form-control"
                                        data-fos-description="{{ $program['code'] }}"
                                        value="{{ $program['description'] }}" />
                                    <input type="number" hidden class="form-control"
                                        data-fos-salary="{{ $program['code'] }}"
                                        value="{{ $program['median_earning'] }}" />
                                    <input type="number" hidden class="form-control"
                                        data-fos-debt="{{ $program['code'] }}"
                                        value="{{ $program['debt_after_graduation'] }}" />
                                @endforeach
                                @foreach ($programs_local_data as $program)
                                    <div class="mt-4">
                                        <div class="bg-dark p-3 text-white">{{ $program->title }} </div>
                                        <br />
                                        {{-- ID of Program --}}
                                        <input type="number" hidden class="form-control"
                                            name="field_of_study[{{ $program->code }}][id]"
                                            id="field_of_study[{{ $program->code }}][id]"
                                            value="{{ $program->id }}" />
                                        <div class="mt-2">
                                            <div class="d-flex justify-content-between mb-2">
                                                <label for="field_of_study[{{ $program->code }}][description]">
                                                    Description
                                                </label>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        data-fos-id="{{ $program->code }}" id="resetDescription">Reset
                                                        Description</button>
                                                </div>
                                            </div>
                                            <textarea type="text" class="form-control" name="field_of_study[{{ $program->code }}][description]"
                                                id="field_of_study[{{ $program->code }}][description]">{{ $program->description ?? '' }}</textarea>

                                        </div>
                                        <div class="mt-2">
                                            <div class="d-flex justify-content-between mb-2">
                                                <label
                                                    for="field_of_study[{{ $program->code }}][salary_after_completing]">
                                                    Salary After Completing
                                                </label>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        data-fos-id="{{ $program->code }}" id="resetSalary">Reset
                                                        Salary</button>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control"
                                                name="field_of_study[{{ $program->code }}][salary_after_completing]"
                                                id="field_of_study[{{ $program->code }}][salary_after_completing]"
                                                value="{{ $program->median_earning ?? '' }}" />

                                        </div>
                                        <div class="mt-2">
                                            <div class="d-flex justify-content-between mb-2 ">
                                                <label
                                                    for="field_of_study[{{ $program->code }}][median_debt_after_graduation]">
                                                    Median Debt After Graduation
                                                </label>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        data-fos-id="{{ $program->code }}" id="resetDebt">Reset
                                                        Debt</button>
                                                </div>

                                            </div>
                                            <input type="number" class="form-control"
                                                name="field_of_study[{{ $program->code }}][median_debt_after_graduation]"
                                                id="field_of_study[{{ $program->code }}][median_debt_after_graduation]"
                                                value="{{ $program->debt_after_graduation ?? '' }}" />

                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('admin-script')
    <script src="{{ asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('assets/js/lib/vue.global.min.js') }}"></script>

    <script>
        let resetButtons = $('[data-fos-id]');
        resetButtons.each(function() {
            if ($(this).attr('id') == 'resetDescription') {
                $(this).on('click', function() {
                    let fosId = $(this).data('fos-id');
                    let description = $(`[data-fos-description="${fosId}"]`).val();
                    $(`#field_of_study\\[${fosId}\\]\\[description\\]`).val(description);
                })
            }
            if ($(this).attr('id') == 'resetSalary') {
                $(this).on('click', function() {
                    let fosId = $(this).data('fos-id');
                    let salary = $(`[data-fos-salary="${fosId}"]`).val();
                    $(`#field_of_study\\[${fosId}\\]\\[salary_after_completing\\]`).val(salary);
                })
            }
            if ($(this).attr('id') == 'resetDebt') {
                $(this).on('click', function() {
                    let fosId = $(this).data('fos-id');
                    let debt = $(`[data-fos-debt="${fosId}"]`).val();
                    $(`#field_of_study\\[${fosId}\\]\\[median_debt_after_graduation\\]`).val(debt);
                })
            }
        });


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
        function toggleBetweenAdminAndPetersonData(checkboxSelector, selectorsOfElToHide, selectorsOfElToShow) {
            $(checkboxSelector).change(function() {
                if (this.checked) {
                    selectorsOfElToHide.forEach(element => $(element).prop('hidden', true))
                    selectorsOfElToShow.forEach(element => $(element).removeAttr('hidden'))
                } else {
                    selectorsOfElToShow.forEach(element => $(element).prop('hidden', true))
                    selectorsOfElToHide.forEach(element => $(element).removeAttr('hidden'))
                }
            })

        }
        // toggleBetweenAdminAndPetersonData('#display_peterson_public_coa',['.public_coa_container_admin'] , ['.public_coa_container'])
        // toggleBetweenAdminAndPetersonData('#display_peterson_pvt_coa',['.pvt_coa_container_admin'] , ['.pvt_coa_container'])
    </script>

    <script>
        const apiData = @json($apiData);
        const collegeInfo = @json($info);

        const rollingAdmissionDay = "{{ old('rolling_admission_day', $info->rolling_admission_day) }}";
        const rollingAdmissionMonth = "{{ old('rolling_admission_month', $info->rolling_admission_month) }}";
        const regularDecisionDay = "{{ old('regular_decision_day', $info->regular_decision_day) }}";
        const regularDecisionMonth = "{{ old('regular_decision_month', $info->regular_decision_month) }}";
        const earlyDecisionIIDay = "{{ old('early_decision_ii_day', $info->early_decision_ii_day) }}";
        const earlyDecisionIIMonth = "{{ old('early_decision_ii_month', $info->early_decision_ii_month) }}";
        const earlyDecisionIDay = "{{ old('early_decision_i_day', $info->early_decision_i_day) }}";
        const earlyDecisionIMonth = "{{ old('early_decision_i_month', $info->early_decision_i_month) }}";
        const earlyActionDay = "{{ old('early_action_day', $info->early_action_day) }}";
        const earlyActionMonth = "{{ old('early_action_month', $info->early_action_month) }}";

        // init vue3 instance
        const admissionDeadlineVue = Vue.createApp({
            data() {
                return {
                    rolling_admission_day: rollingAdmissionDay,
                    rolling_admission_month: rollingAdmissionMonth,
                    regular_decision_day: regularDecisionDay,
                    regular_decision_month: regularDecisionMonth,
                    early_decision_ii_day: earlyDecisionIIDay,
                    early_decision_ii_month: earlyDecisionIIMonth,
                    early_decision_i_day: earlyDecisionIDay,
                    early_decision_i_month: earlyDecisionIMonth,
                    early_action_day: earlyActionDay,
                    early_action_month: earlyActionMonth,
                }
            },
            methods: {
                resetFromPetersonData(deadline) {
                    console.log('deadline', deadline);
                    if (deadline === 'rolling_admission') {
                        this.rolling_admission_day = null;
                        this.rolling_admission_month = null;
                    } else if (deadline === 'regular_decision') {
                        this.regular_decision_day = collegeInfo.AP_DL_FRSH_DAY;
                        this.regular_decision_month = collegeInfo.AP_DL_FRSH_MON;
                    } else if (deadline === 'early_decision_ii') {
                        this.early_decision_ii_day = collegeInfo.AP_DL_EDEC_2_DAY
                        this.early_decision_ii_month = collegeInfo.AP_DL_EDEC_2_MON
                    } else if (deadline === 'early_decision_i') {
                        this.early_decision_i_day = collegeInfo.AP_DL_EDEC_1_DAY
                        this.early_decision_i_month = collegeInfo.AP_DL_EDEC_1_MON
                    } else if (deadline === 'early_action') {
                        this.early_action_day = collegeInfo.AP_DL_EACT_DAY
                        this.early_action_month = collegeInfo.AP_DL_EACT_MON
                    }
                },
            }
        }).mount('#admission-deadline');

        const publicCoaInState = "{{ old('public_coa_in_state', $info->public_coa_in_state) }}";
        const publicCoaOutState = "{{ old('public_coa_out_state', $info->public_coa_out_state) }}";
        const pvtCoa = "{{ old('pvt_coa', $info->pvt_coa) }}";
        const tutionAndFess = "{{ old('tution_and_fess', $info->tution_and_fess) }}"; // "Tuition and Fee"
        const tuitionAndFeeInstate = "{{ old('tuition_and_fee_instate', $info->tuition_and_fee_instate) }}";
        const tuitionAndFeeOutstate = "{{ old('tuition_and_fee_outstate', $info->tuition_and_fee_outstate) }}";


        const admissionCost = Vue.createApp({
            data() {
                return {
                    public_coa_in_state: publicCoaInState,
                    public_coa_out_state: publicCoaOutState,
                    pvt_coa: pvtCoa,
                    tution_and_fess: tutionAndFess, // "Tuition and Fee"
                    tuition_and_fee_instate: tuitionAndFeeInstate,
                    tuition_and_fee_outstate: tuitionAndFeeOutstate,
                }
            },
            methods: {
                resetFromScorecardData(costType) {
                    console.log('costType', costType);

                    const cost = apiData.latest.cost

                    if (costType === 'tuition_and_fee_instate') {
                        this.tuition_and_fee_instate = cost.tuition.in_state;
                    } else if (costType === 'tuition_and_fee_outstate') {
                        this.tuition_and_fee_outstate = cost.tuition.out_of_state;
                    } else if (costType === 'tuition_and_fee_pvt') {
                        this.tution_and_fess = cost.tuition.program_year;
                    }

                },
                resetFromPetersonData(costType) {
                    console.log('costType', costType);

                    // for COA from UG_EXPENSE_ASGNS
                    // in-state: TUIT_STATE_FT_D + FEES_FT_D + RM_BD_D + BOOKS_RES_D
                    // out-of-state: TUIT_NRES_FT_D + FEES_OOS_FT_D + RM_BD_D + BOOKS_RES_D
                    // private: TUIT_OVERALL_FT_D + FEES_FT_D + RM_BD_D + BOOKS_RES_D
                    const tuitStateFtD = collegeInfo.TUIT_STATE_FT_D ? parseFloat(collegeInfo.TUIT_STATE_FT_D) : 0;
                    const tuitOverallFtD = collegeInfo.TUIT_OVERALL_FT_D ? parseFloat(collegeInfo
                        .TUIT_OVERALL_FT_D) : 0;
                    const tuitNresFtD = collegeInfo.TUIT_NRES_FT_D ? parseFloat(collegeInfo.TUIT_NRES_FT_D) : 0;
                    const feesFtD = collegeInfo.FEES_FT_D ? parseFloat(collegeInfo.FEES_FT_D) : 0;
                    const rmBdD = collegeInfo.RM_BD_D ? parseFloat(collegeInfo.RM_BD_D) : 0;
                    const booksResD = collegeInfo.BOOKS_RES_D ? parseFloat(collegeInfo.BOOKS_RES_D) : 0;

                    if (costType === 'public_coa_in_state') {
                        this.public_coa_in_state = tuitStateFtD + feesFtD + rmBdD + booksResD;
                    } else if (costType === 'public_coa_out_state') {
                        this.public_coa_out_state = tuitNresFtD + feesFtD + rmBdD + booksResD;
                    } else if (costType === 'pvt_coa') {
                        this.pvt_coa = tuitOverallFtD + feesFtD + rmBdD + booksResD;
                    }
                }
            }
        }).mount('#admission-cost');
    </script>
@endsection
