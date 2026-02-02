@props(['user' => null, 'size' => 'sm'])
<div class="d-flex align-items-center">

    <x-page.avatar :size="$size" :user="$user" />

    @if($slot->isEmpty())
    <div class="font-weight-medium">{{ $user->name }}</div>
    @else
        {{ $slot }}
    @endif
    {{-- <a href="{{ route('instructor.show', $item) }}" wire:navigate>{{ $user->name }}</a> --}}
</div>

