{{--
var =   class_group,
        field_name,
        type,
        label,
        value,
        placeholder
    --}}
{{-- {{ dd($item) }} --}}
<div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>
    <label class="form-label" for="{{ $field_name }}">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    <input min="{{ $min }}" max="{{ $max }}"
        oninput="if (this.value < {{ $min }}) this.value = {{ $min }}; if (this.value > {{ $max }}) this.value = {{ $max }}"
        type="{{ $type ?? 'number' }}" name="{{ strtolower($field_name) }}"
        {{ isset($disabled) && $disabled ? 'disabled' : '' }}
        {{ isset($required) && $required ? 'required' : '' }} class="form-control" id="{{ $field_name }}"
        value="{{ $value ?? null }}" placeholder="{{ $placeholder ? str_replace('_', ' ', $placeholder) : null }}">
</div>

@if ($accept == 'disable-minus')
    @section('script')
        @parent
        <script>
            $('#{{ $field_name }}').on('keyup', function() {
                let value = Math.abs(this.value)
                $(this).val(value)
            });
        </script>
    @endsection
@endif
