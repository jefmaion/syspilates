<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($weekdays as $item)
        <option value="{{ $item->value }}">{{ $item->label() }}</option>
    @endforeach
</x-form.select>