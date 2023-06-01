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