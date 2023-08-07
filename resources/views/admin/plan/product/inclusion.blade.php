<div class="mb-4">
    <label for="description" class="form-label">Inclusion: 
        <span style="cursor: pointer" class="p-1 px-2 btn btn-alt-success" onclick="addInclusion()">+</span>
    </label>
    <div id="inclusion-holder">
        <div style="display: flex" class="mb-2">
            <input type="text" class="form-control form-control-lg form-control-alt" name="inclusion[]"
                   placeholder="Inclusion" required>
        </div>
    </div>
    @error('description')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>

@section('admin-script')
    <script>
        function addInclusion(val = '', canBeRemoved = true) {
            let html = ''
            html += '<div style="display: flex" class="mb-2">';
            html += `<input type="text" class="form-control form-control-lg form-control-alt" name="inclusion[]" placeholder="Inclusion" value="${val}" required>`;
            if (canBeRemoved) {
                html += '<span style="cursor: pointer; margin-left: 12px" class="p-2 px-3 btn btn-alt-danger" onclick="removeInclusion(this)">-</span>';
            }
            html += '</div>';
            $('#inclusion-holder').append(html);
        }

        function removeInclusion(ele) {
            $(ele).parent().remove()
            if (!$('#inclusion-holder').children().length) {
                addInclusion('', false);
            }
        }

        @php
            $inclusions = [];
            if (isset($product)) {
                $inclusions = array_map(function ($item) {
                    return $item['inclusion'];
                }, $product->inclusions->toArray());
            }
            if (old('inclusion')) {
                $inclusions = old('inclusion');
            }
        @endphp
        const incs = {!! json_encode($inclusions) !!};
        if (incs.length) {
            $('#inclusion-holder').html('');
            incs.forEach((item, inx) => {
                addInclusion(item);
            })
        }
    </script>
@endsection
