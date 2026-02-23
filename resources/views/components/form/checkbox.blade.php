@props(['checked' => false])
<label class="form-check">
    <input type="checkbox" {{ $attributes->merge(['class' => 'form-check-input'])}} value="{{ $value ?? null}}"
    @if($checked == true) checked @endif>
    <span class="form-check-label">{{ $slot }}</span>
</label>