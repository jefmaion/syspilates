<x-table.table :search="false">
    <thead>
        <tr>
            <th scope="col">Dia</th>
            <th scope="col">Horário</th>
            <th scope="col">Instrutor</th>
            <th>Tipo da Falta</th>
            <th>Expira em:</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($markups as $date => $class)

        <tr class="">
            <td scope="row">{{
                $class->origin->datetime->format('d/m/y') }}
                / {{
                ucfirst($class->origin->datetime->isoFormat('ddd'))
                }}
            </td>
            <td>{{ $class->origin->datetime->format('H:i')
                }}</td>
            <td>
                <x-page.user-avatar size="xs" :user="$class->origin->instructor->user">
                    <span class="small">
                        {{
                        $class->origin->instructor->user->shortName
                        }}
                    </span>
                </x-page.user-avatar>
            </td>
            <td>
                {{ $class->origin->status->label() }}
            </td>

            <td>
                {{ $class->expires_at->format('d/m/y') }}
            </td>

            <td class="text-center">
                <div class="btn-actions">
                    <a class="btn btn-action" href="#" wire:click="editClass({{ $class->id }})">
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