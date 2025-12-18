<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($students as  $item)
        <option value="{{ $item->id }}">{{ $item->user->name }}</option>
    @endforeach
</x-form.select>