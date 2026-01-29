@props(['disabled' => false])
<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'form-control'   . ($errors->has($attributes->get('name')) ? ' is-invalid' : '')]) }}>{{ $slot }}</textarea>
@error($attributes->get('name'))<div class="invalid-feedback">{{ $message }}</div>@enderror
