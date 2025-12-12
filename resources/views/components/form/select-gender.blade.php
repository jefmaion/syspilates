<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($genders as  $item)
        <option value="{{ $item->value }}">{{ $item->label() }}</option>
    @endforeach
</x-form.select>