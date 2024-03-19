<div class="row owl-carousel owl-theme m-0">

    @if (count($college_list_deadline) > 0)
        @foreach ($college_list_deadline as $key => $deadline)
            <div class="col-12" style="height : 290px !important; " id="{{ $deadline['college_deadline']['id'] }}">
                <div style="min-height:100% !important;  "
                    class="block block-bordered shadow py-3 px-2 gap-1 d-flex flex-column align-items-center  @if (!$deadline['college_information']['regular_admission_deadline'])  @endif">
                    @if ($deadline['college_information']['college_icon'])
                        <img class="college-image"
                            src="{{ asset('college_icon/' . $deadline['college_information']['college_icon']) }}"
                            alt="">
                    @else
                        <img class="college-image" src="{{ asset('static-image/college-logo.png') }}" alt="">
                    @endif
                    <div class="fs-sm fw-semibold text-muted text-uppercase">Choice #{{ $key + 1 }}</div>
                    <a class="text-dark text-center">{{ $deadline['college_name'] }}</a>
                    @if (!empty($deadline['deadline_date']['date']))
                        @if($deadline['deadline_date']['date'])
                        <div class="fs-sm fw-semibold text-muted text-uppercase">Admissions Deadline</div>
                        <div class="fs-xs text-muted text-italic">{{ $deadline['college_deadline']['admission_option'] }}</div>
                        <div class="deadline-div text-center">
                            <span class="text-dark d-block">{{ $deadline['deadline_date']['dateLabel'] }}</span>
                            <span class="text-dark d-block fs-xs {{ $deadline['deadline_date']['diff'] < 0 ? 'text-danger' : '' }}">{{ $deadline['deadline_date']['diffLabel'] }}</span>
                        </div>
                        @else
                        <div class="deadline-div text-center">
                            <span class="text-danger d-block">Not Published</span>
                        </div>
                        @endif
                    @endif
                    <button type="button" class="btn btn-sm btn-alt-secondary mt-2 manage-deadline"
                        data-bs-toggle="modal" data-bs-target="#deadline-modal"
                        data-dead-line="{{ @$deadline['deadline_date']['dateInput'] }}"
                        data-deadline-id="{{ $deadline['college_deadline']['id'] }}">{{ !empty($deadline['deadline_date']['diff']) ? 'Edit' : 'Add' }} deadline</button>
                </div>
            </div>
        @endforeach
    @endif
    @php
        $total_element = count($college_list_deadline) == 0 ? 1 : 1;
    @endphp
    @for ($i = 0; $i < $total_element; $i++)
        <div class="col-12" style="height:271px!important">
            <div class="block block-bordered shadow py-3 px-2 gap-1 d-flex flex-column align-items-center box-height"
                style="height : 100%;">
                <img class="college-image" src="{{ asset('static-image/college-logo.png') }}" alt="">
                <div class="fs-sm fw-semibold text-muted text-uppercase">Choice
                    #{{ count($college_list_deadline) + $i + 1 }}</div>
                <a href="{{ route('admin-dashboard.initialCollegeList.step1') }}"
                    class="btn btn-alt-success btn-sm">Add
                    college</a>
            </div>
        </div>
    @endfor
</div>
<div class="modal fade" id="deadline-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add/Edit deadline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <label class="form-label" for="admissions_deadline-0">Admissions Deadline</label>
                    <input type="text" class="deadline-date form-control update-form" data-index="0" value="mm/dd/yy"
                        placeholder="mm/dd/yy" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update-deadline"
                    onclick="updateDeadline(this.dataset['id'], this.dataset['date'])">Save changes</button>
            </div>
        </div>
    </div>
</div>
