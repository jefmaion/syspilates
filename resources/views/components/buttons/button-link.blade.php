<a  wire:navigate {{ $attributes->merge(['class' => 'btn btn-1 d-inline-flex align-items-center gap-1']) }}>
    {{-- <x-icons.edit class="" />
    <span class="d-none d-sm-inline">Editar</span> --}}

    {{ $slot }}
</a>