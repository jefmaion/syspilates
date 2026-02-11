@props(['disabled' => false, 'name'])
<input @disabled($disabled) id="{{$name}}" {{ $attributes->merge(['class' => 'form-control' .
($errors->has($attributes->get('name')) ?
' is-invalid' : '')]) }}>
@error($attributes->get('name'))<div class="invalid-feedback">{{ $message }}</div>@enderror

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const el = document.getElementById("{{ $name }}");
    if (el) {
        IMask(el, {
            mask: Number,
            scale: 2,
            thousandsSeparator: '.',
            radix: ',',
            mapToRadix: ['.'],
            normalizeZeros: true,
            padFractionalZeros: true,
            min: 0,
            overwrite: true
        });
    }
});
</script>
@endpush