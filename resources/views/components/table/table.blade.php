@props(['search' => true, 'search_fieldname' => 'search'])

<div class="table-responsive msb-2">
    @if($search)
    <x-table.table-search search_fieldname="{{$search_fieldname}}" class="mb-4" />
    @endif
    <table {{ $attributes->merge(['class' => 'table table-striped table-vcenter']) }}>
        {{ $slot }}
    </table>
</div>
