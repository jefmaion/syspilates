<div>
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.list />
            Planos
        </h2>
        <x-slot name="actions">
            <div class="btn-list">
                <a href="#" wire:click="$dispatch('create-plan')"
                    class="btn btn-primary btn-5 d-none d-sm-inline-block">
                    <x-icons.plus class="icon icon-1" /> Novo
                </a>
                <a href="#" wire:click="$dispatch('create-plan')" class="btn btn-primary btn-6 d-sm-none btn-icon"
                    aria-label="Novo">
                    <x-icons.plus class="icon icon-1" />
                </a>
            </div>
        </x-slot>

    </x-page.page-header>

    <x-page.page-body>




        <div class="card">
            <div class="card-header">
                <x-table.table-search />
            </div>

            <div class="card-body">
                @if ($plans->isNotEmpty())
                <x-table.table :search="false" class="fs-4">
                    <thead>
                        <tr>
                            <th>Plano</th>
                            <th>Valor</th>
                            <th>Data de Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->name
                                }}</td>
                            <td>R$ {{ currency($plan->value) }}</td>
                            <td>{{ $plan->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-actions">
                                    <a class="btn btn-action"
                                        wire:click="$dispatch('edit-plan', {id: {{ $plan->id }}})">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/edit -->
                                        <x-icons.edit class="" />
                                    </a>
                                    <a class="btn btn-action text-danger"
                                        wire:click="$dispatch('delete-plan', { plan: {{ $plan }} })">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/copy -->
                                        <x-icons.trash />
                                    </a>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>

                <div class="mt-3">
                    {{ $plans->links() }}
                </div>

                @else
                <div class="text-center">Nenhum registro encontrado.</div>
                @endif
            </div>
            <livewire:plan.delete-plan />
            <livewire:plan.create-plan />

    </x-page.page-body>
</div>