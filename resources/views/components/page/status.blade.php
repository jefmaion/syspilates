@props(['color' => 'green'])
<span class="status status-lite status-{{ $color }}">
    <span class="status-dot"></span>
    {{ $slot }}
</span>