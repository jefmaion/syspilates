<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($durations as $id => $label)
        <option value="{{ $id }}">{{ $label }}</option>
    @endforeach
</x-form.select>