<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($status as $id => $label)
        <option value="{{ $id }}">{{ $label }}</option>
    @endforeach
</x-form.select>