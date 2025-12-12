<select {{ $attributes->merge(['class' => 'form-select '. ($errors->has($attributes->get('name')) ? ' is-invalid' : '')]) }}>
    {{ $slot }}
</select>
@error($attributes->get('name'))<div class="invalid-feedback">{{ $message }}</div>@enderror
