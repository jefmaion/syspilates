<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($categories as $id => $cat)
        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
    @endforeach
</x-form.select>