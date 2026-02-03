@props(['color' => 'green', 'icon' => null])
<span class="px-2 py-1 badge bg-{{ $color }} text-{{ $color }}-fg">
    @if($icon) <x-dynamic-component component="{{ $icon }}" /> @endif
    {{ $slot }}
</span>