@props(['color' => 'green'])
<span class="text-sm status status-lite status-{{ $color }}">
    <span class="status-dot"></span>
    {{ $slot }}
</span>