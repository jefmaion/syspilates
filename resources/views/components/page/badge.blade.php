@props(['color' => 'green', 'icon' => null])
<span class="badge bg-{{ $color }} text-{{ $color }}-fg">
    @if($icon) <x-dynamic-component component="{{ $icon }}" /> @endif
    {{ $slot }}
</span>