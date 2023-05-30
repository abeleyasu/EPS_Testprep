<div class="setup-content {{ $ishide ? 'd-none' : '' }}" role="tabpanel" id="{{ $id }}" aria-labelledby="step1-tab">
    <div class="accordion accordionExample1">
        <div class="block block-rounded block-bordered overflow-hidden mb-1">
            <div class="block-header block-header-tab" type="button" data-toggle="collapse" data-target="#{{ $accordion_id }}" aria-expanded="true" aria-controls="collapseOne">
                <a class=" text-white fw-600 collapsed">{{ $title }} <i class="fa fa-2x fa-angle-down"></i></a>
            </div>
            <div id="{{ $accordion_id }}" class="collapse" aria-labelledby="headingOne" data-parent=".accordionExample1">
                <div class="college-content-wrapper college-content">
                    @foreach($options as $key => $option)
                    <div class="mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="{{ isset($text_key) ? $option[$text_key]  : $option }}{{ $key }}" value="{{ isset($value_key) ? $option[$value_key]  : $option }}" name="{{ $name }}">
                            <label class="form-check-label" for="{{ isset($text_key) ? $option[$text_key]  : $option }}{{ $key }}">
                                {{ isset($text_key) ? $option[$text_key]  : $option }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>