<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($modalities as  $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
</x-form.select>