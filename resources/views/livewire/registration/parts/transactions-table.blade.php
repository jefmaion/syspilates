<x-table.table :search="false">
    <thead>
        <tr>
            <th scope="col">Data Vencto.</th>
            <th scope="col">Data Pagamento:</th>
            <th scope="col">Valor</th>
            <th scope="col">Status</th>
            <th></th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $date => $item)

        <tr class="">
            <td scope="row">
                {{ $item->date->format('d/m/y') }}
            </td>

            <td>
                {{ $item->paid_at?->format('d/m/y') ?? '-' }}

            </td>

            <td>
                R$ {{ currency($item->amount) }}
            </td>
            <td>

                <x-page.badge color="{{ $item->currentStatus->color }}">{{ $item->currentStatus->label }}</x-page.badge>


            </td>

            <td>
                {{ $item->payment_method?->label() }}
            </td>



            <td class="text-center">
                <div class="btn-actions">
                    <a class="btn btn-action" href="#"
                        wire:click="$dispatch('pay-transaction', { id: {{ $item->id }}})">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-1">
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                            </path>
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                            </path>
                            <path d="M16 5l3 3"></path>
                        </svg>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</x-table.table>
{{$markups->links()}}