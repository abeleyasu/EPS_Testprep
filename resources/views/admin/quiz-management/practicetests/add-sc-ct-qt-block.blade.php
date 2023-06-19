<div class="input-container" id="{{ $disp_section }}add_New_Types_{{ $ans_choices }}">
    <div class="d-flex input-field align-items-center">

        <div class="col-md-2">
            <label class="form-label" for="{{ $disp_section }}ct_checkbox_{{ $ans_choices }}">Concept Correct?</label>
            <input type="checkbox" name="{{ $disp_section }}ct_checkbox_{{ $ans_choices }}" id="{{ $disp_section }}ct_checkbox_{{ $ans_choices }}_0">
        </div>

        <div class="col-md-3 mb-2 me-2 rating-tag">
            <label class="form-label" for="superCategory">Super Category<span class="text-danger">*</span></label>
            <div class="d-flex align-items-center">
                <select class="js-select2 select superCategory" id="{{ $disp_section }}super_category_create_{{ $ans_choices }}_0" name="{{ $disp_section }}super_category_create_{{ $ans_choices }}" data-id="0" onchange="insertSuperCategory(this)" multiple>
                </select>
            </div>
            <span class="text-danger" id="{{ $disp_section }}superCategoryError_{{ $ans_choices }}"></span>
        </div>

        <div class="col-md-3 mb-2 me-2 category-custom">
            <label for="category_type" class="form-label">Category Type<span class="text-danger">*</span></label>
            <div class="d-flex align-items-center">
                <select class="js-select2 select categoryType" id="{{ $disp_section }}add_category_type_{{ $ans_choices }}_0" name="{{ $disp_section }}add_category_type_{{ $ans_choices }}" data-id="0" onchange="insertCategoryType(this)" multiple>
                </select>
            </div>
            <span class="text-danger" id="{{ $disp_section }}categoryTypeError_{{ $ans_choices }}"></span>
        </div>

        <div class="mb-2 col-md-3 add_question_type_select">
            <label for="search-input" class="form-label">Question Type<span class="text-danger">*</span></label>
            <div class="d-flex align-items-center">
                <select class="js-select2 select questionType" id="{{ $disp_section }}add_search-input_{{ $ans_choices }}_0" name="{{ $disp_section }}add_search-input_{{ $ans_choices }}" data-id="0" onchange="insertQuestionType(this)" multiple>
                </select>
            </div>
            <span class="text-danger" id="{{ $disp_section }}questionTypeError_{{ $ans_choices }}"></span>
        </div>

        <div class="col-md-1 add-position">
            <button class="plus-button add-plus-button" ans_col='{{ $ans_choices }}' data-id="1" onclick="addNewType(this, '{{ $disp_section }}')"><i class="fa-solid fa-plus"></i></button>
        </div>
    </div>
</div>