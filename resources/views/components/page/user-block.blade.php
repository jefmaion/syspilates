@props(['user' => null])
<div class="d-flex align-items-center">
    <span class="avatar avatar-sm me-2  {{ ($user->gender == 'M') ? 'bg-blue-lt' : 'bg-purple-lt' }}">{{$user->initials }}</span>
    @if($slot->isEmpty())
{{ $user->name }}
    @else
        {{ $slot }}
    @endif

    {{-- <a href="{{ route('instructor.show', $item) }}" wire:navigate>{{ $user->name }}</a> --}}
</div>