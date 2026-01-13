@props(['search' => true])
<div class="table-responsive mb-2">
    @if($search)
    <x-table.table-search class="mb-4" />
    @endif
    <table {{ $attributes->merge(['class' => 'table table-striped table-vcenter']) }}>
        {{ $slot }}
    </table>
</div>