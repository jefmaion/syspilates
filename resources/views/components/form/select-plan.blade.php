<x-form.select {{ $attributes }}>
    <option value=""></option>
    @foreach($plans as $plan)
    <option value="{{ $plan->id }}">{{ $plan->name }} @if($show_value) (R$ {{ currency($plan->value) }}) @endif</option>
    @endforeach
</x-form.select>