<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($payments as $key => $item)
        <option value="{{ $key }}">{{ $item }}</option>
    @endforeach
</x-form.select>