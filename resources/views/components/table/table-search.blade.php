@props(['search_fieldname' => 'search', 'pagesName' => 'pages'])

<div {{ $attributes->merge(['class' => 'd-flex w-100 fs-4 justify-content-between']) }}>

    <div class="text-secondary">
        <span class="d-none d-sm-inline">Mostrar</span>
        <div class="mx-2 d-inline-block">
            <input type="text" class="form-control" wire:model.live="{{$pagesName}}" size="3" aria-label="Invoices count">
        </div>
        <span class="d-none d-sm-inline">por página</span>
    </div>

    <div class="ms-auto text-secondary">
        <div class="ms-2 d-inline-block">
            <input type="text" wire:model.live="{{ $search_fieldname }}" class="form-control" placeholder="Pesquisar..." aria-label="Search invoice">
        </div>
    </div>

</div>
