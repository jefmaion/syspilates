@props(['search' => true])
<div class="table-responsive">
    @if($search)
    <x-table.table-search />
    @endif
    <table {{ $attributes->merge(['class' => 'table table-striped table-vcenter']) }}>
        {{ $slot }}
    </table>
</div>