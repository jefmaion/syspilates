<div class="table-responsive">
    <x-table.table-search />
    <table {{ $attributes->merge(['class' => 'table table-striped']) }}>
        {{ $slot }}
    </table>
</div>