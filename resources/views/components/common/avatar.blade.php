@props([
    'initials' => null,
    'avatar' => null,
    'color' => 'primary',
    'size' => 'lg',
])
<span {{ $attributes->merge(['class' => ' bg-' . $color . '-lt text-' . $color . '-lt-fg avatar avatar-' . $size . ' ']) }} @if (!empty($avatar)) style="background-image: url({{ asset('storage/' . $avatar) }})" @endif>
    @if (empty($avatar))
        {{ $initials }}
    @else
        {{ $slot }}
    @endif
</span>
