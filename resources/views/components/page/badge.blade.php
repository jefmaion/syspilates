@props(['color' => 'green', 'icon' => null, 'style' => null])
<span {{ $attributes->merge(['class' => 'px-2 py-1 badge  bg-'.$color.' text-'. $color .'-fg']) }}>
    @if($icon) <x-dynamic-component component="{{ $icon }}" /> @endif
    {{ $slot }}
</span>