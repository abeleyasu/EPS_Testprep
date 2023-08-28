@php 
    $bg_color = 'bg-black';
    $text_color = 'text-white';
    $grid = 'col-6 col-md-3';
    $margin = '';
    if (isset($is_main_dashboard) && $is_main_dashboard) {
        $bg_color = 'bg-white';
        $text_color = 'text-dark';
        $grid = 'col-12 col-sm-6 col-lg-3 p-0';
        $margin = 'm-1';
    }
@endphp
<div class="row text-center">
    <div class="{{ $grid }}">
        <div class="block block-bordered shadow test-block {{ $bg_color }} {{ $margin }}">
            <a class="btn-block-option editPrimaryTest" href="javascript:void(0)" style="float: right">
                <i class="fas fa-edit" style="color: #0099ff;"></i>
            </a>
            <br>
            <div class="fs-md fw-semibold text-uppercase" style="color: #0099ff">Primary Test</div>
            <div class="fs-lg fw-semibold {{ $text_color }} text-uppercase selectedPrimaryTest">
                {!! optional($getTestScores)->primary_test_type ?? '<span style="font-size: 5.5px;">Please input your primary test by clicking on <i class="fas fa-edit" style="color: #0099ff;"></i> button</span>' !!}
            </div>
            <div id="editDropdownContainer" style="display: none;">
                <select id="testTypeDropdown">
                    <option value="">Select</option>
                    <option value="ACT" {{ optional($getTestScores)->primary_test_type === 'ACT' ? 'selected' : '' }}>ACT</option>
                    <option value="SAT" {{ optional($getTestScores)->primary_test_type === 'SAT' ? 'selected' : '' }}>SAT</option>
                    <option value="PSAT" {{ optional($getTestScores)->primary_test_type === 'PSAT' ? 'selected' : '' }}>PSAT</option>
                </select>
            </div>
            <br>
        </div>
    </div>
    <div class="{{ $grid }}">
        <div class="block block-bordered shadow test-block {{ $bg_color }} {{ $margin }}">
            <a class="btn-block-option editInitialScore" href="javascript:void(0)" style="float: right">
                <i class="fas fa-edit" style="color: #0099ff;"></i>
            </a>
            <br>
            <div class="fs-md fw-semibold text-uppercase" style="color: #0099ff">Initial Score</div>
            <div class="fs-lg fw-semibold {{ $text_color }} text-uppercase initialScoreCls">
                {{ optional($getTestScores)->initial_score ?? '0' }}
            </div>
            <div id="editInitialScoreContainer" style="display: none;">
                <input style="width: 50px; text-align: center;" type="text" name="txtinitialScore" id="txtinitialScore" value="{{ optional($getTestScores)->initial_score ?? '0' }}" autocomplete="off">
            </div>
            <br>
        </div>
    </div>
    <div class="{{ $grid }}">
        <div class="block block-bordered shadow test-block {{ $bg_color }} {{ $margin }}">
            <br>
            <div class="fs-md fw-semibold text-uppercase" style="color: #0099ff">Last Test</div>
            <div class="fs-lg fw-semibold {{ $text_color }} text-uppercase lastTestCls">
                {{ optional($getTestScores)->last_test_score ?? '0' }}
            </div>
            <br>
        </div>
    </div>
    <div class="{{ $grid }}">
        <div class="block block-bordered shadow test-block {{ $bg_color }} {{ $margin }}">
            <a class="btn-block-option editGoalScore" href="javascript:void(0)" style="float: right">
                <i class="fas fa-edit" style="color: #0099ff;"></i>
            </a>
            <br>
            <div class="fs-md fw-semibold text-uppercase" style="color: #0099ff">Goal Score</div>
            <div class="fs-lg fw-semibold {{ $text_color }} text-uppercase goalScoreCls">
                {{ optional($getTestScores)->goal_score ?? '0' }}
            </div>
            <div id="editGoalScoreContainer" style="display: none;">
                <input style="width: 50px; text-align: center;" type="text" name="txtgoleScore" id="txtgoalScore" value="{{ optional($getTestScores)->goal_score ?? '0' }}" autocomplete="off">
            </div>
            <br>
        </div>
    </div>
</div>