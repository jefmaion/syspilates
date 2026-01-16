@props(['user' => null, 'size' => 'sm'])
@if(empty($user))
@else
<div {{ $attributes->merge(['class' => 'd-flex align-items-center']) }}>
    <span class="avatar avatar-{{ $size }} me-2  {{ ($user->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{$user->initials }}</span>
    @if($slot->isEmpty())
    <div class="font-weight-medium">{{ $user->name }}</div>
    @else
        {{ $slot }}
    @endif
    {{-- <a href="{{ route('instructor.show', $item) }}" wire:navigate>{{ $user->name }}</a> --}}
</div>

@endif