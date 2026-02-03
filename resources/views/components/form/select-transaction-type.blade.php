<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($types as $key => $item)
        <option value="{{ $key }}">{{ $item }}</option>
    @endforeach
</x-form.select>