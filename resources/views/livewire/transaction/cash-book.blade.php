<div>
    @section('title') Lançamentos @endsection
    <x-page.page-header>
        <h2 class="page-title">
            <x-icons.users />
            Livro Caixa
        </h2>
        <x-slot name="actions">
            <a href="#" class="btn btn-primary" wire:click="$dispatch('create-transaction')">Novo</a>
        </x-slot>
    </x-page.page-header>

    <x-page.page-body>

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                    @foreach($transactions as $k => $val)
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-home-{{ $k }}" class="nav-link" data-bs-toggle="tab" aria-selected="true"
                            role="tab">{{ $k }}</a>
                    </li>
                    @endforeach
                    {{-- <li class="nav-item" role="presentation">
                        <a href="#tabs-profile-8" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                            tabindex="-1" role="tab">Profile</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-activity-8" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                            tabindex="-1" role="tab">Activity</a>
                    </li> --}}
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    @foreach($transactions as $k => $val)
                    <div class="tab-pane fade" id="tabs-home-{{ $k }}" role="tabpanel">
                        <h4>Receitas: <strong>{{ currency($val['c']) }}</strong> | Despesas: <strong>{{ currency($val['d']) }}</strong></h4>
                        <x-table.table :search="false">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Categoria</th>
                                    <th>Entrada</th>
                                    <th>Saída</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($val['data'] as $tran)
                                <tr>
                                    <td>{{ $tran->date->format('d/m/Y') }}</td>
                                    <td>{{ $tran->description }}</td>
                                    <td>{{ $tran->category->name }}</td>
                                    <td>{{ $tran->type->value == 'C' ? currency($tran->amount) : '-' }}</td>
                                    <td>{{ $tran->type->value == 'D' ? currency($tran->amount) : '-' }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td>{{ currency($val['c']) }}</td>
                                    <td>{{ currency($val['d']) }}</td>
                                </tr>
                            </tfoot>

                        </x-table.table>
                    </div>
                    @endforeach
                    {{-- <div class="tab-pane fade" id="tabs-profile-8" role="tabpanel">
                        <h4>Profile tab</h4>
                        <div>
                            Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc
                            amet, pellentesque id egestas velit sed
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tabs-activity-8" role="tabpanel">
                        <h4>Activity tab</h4>
                        <div>
                            Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet, facilisi sit
                            mauris accumsan nibh habitant senectus
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>



    </x-page.page-body>
</div>